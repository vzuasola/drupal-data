<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;

use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Language\LanguageInterface;
use Drupal\webcomposer_rest_extra\PagerTrait;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\webcomposer_rest_extra\Plugin\views\style\NodeListSerializer;

/**
 * @ingroup views_style_plugins
 *
 * Serializer specific for the optimized game views
 *
 * @ViewsStyle(
 *   id = "optimized_field_serializer",
 *   title = @Translation("Optimized Field Serializer"),
 *   help = @Translation("Custom serializer for the sorting weight from draggable views"),
 *   display_types = {"data"}
 * )
 */
class OptimizedFieldSerializer extends NodeListSerializer {
  use PagerTrait;

  /**
   * {@inheritdoc}
   */
  public function render() {
    // Get the content type configured in the display or fallback to the
    // default.
    if ((empty($this->view->live_preview))) {
      $content_type = $this->displayHandler->getContentType();
    } else {
      $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
    }

    // Deserialize the data from parent serializer
    // This might cause an error if serialized data is not json
    $data = json_decode(parent::render(), true);

    $temp = [];
    foreach ($data as $entityKey => $entity) {
      foreach ($entity as $fieldKey => $field) {
          // Check if field has exposed_filters data
          if (isset($field['exposed_filters']) && ($fieldKey === 'field_games_list_category')) {
              $exposedFilters = $field['exposed_filters'];
              foreach ($field as $categoryKey => $category) {
                  // Get draggable weight and add to array
                  // with 'draggable' key if it exists

                  $draggable = $this->getDraggableWeight($category['id'], $entity, $exposedFilters);

                  if ($draggable && is_array($data[$entityKey][$fieldKey][$categoryKey])) {
                    $data[$entityKey][$fieldKey][$categoryKey]['draggable'] = $draggable;
                  } else {
                    $data[$entityKey][$fieldKey][$categoryKey] = $draggable;
                  }
              }
          }
        // Remove the exposed filters data for each field
        // This doesn't remove deeper level of arrays
        // Not sure if exposed filters will show up
        if (isset($data[$entityKey][$fieldKey]['exposed_filters'])) {
          unset($data[$entityKey][$fieldKey]['exposed_filters']);
        }
      }
    }

    return $this->serializer->serialize($data, $content_type, ['views_style_plugin' => $this]);
  }

  /**
   * Load terms by taxonomy ID
   * Method forked from Drupal\webcomposer_rest_extra\Normalizer\NodeEntityNormalizer::loadTermById
   * @param string $tid The ID of the game's category
   * @param array $entityData The game entity array
   * @param array $exposedFilters The filters that are exposed on the view
   */
  private function getDraggableWeight($tid, $entityData = [], $exposedFilters = []) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
    $term = Term::load($tid);

    if (!$term) {
      return false;
    }

    $termTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
    $translatedArray = $termTranslated->toArray();

    $nid = $entityData['id'] ?? null;

    if (isset($translatedArray['vid'][0]['target_id']) && !is_null($nid)) {
      $vid = $translatedArray['vid'][0]['target_id'];

      foreach ($exposedFilters as $key => $value) {
        if ($value['vid'] === $vid) {
          $weight = \Drupal::service('webcomposer_rest_extra.draggable_views_weight')->getWeight(
            $value['view_id'],
            $value['display_id'],
            [
              $value['identifier'] => $tid,
              'language' => $lang,
            ],
            $nid
          );
          if (!empty($weight)) {
            // draggable views weight for category
            return $weight;
            break;
          }
        }
      }
    }

    return false;
  }
}
