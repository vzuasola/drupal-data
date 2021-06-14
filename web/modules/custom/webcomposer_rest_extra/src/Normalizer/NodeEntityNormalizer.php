<?php

namespace Drupal\webcomposer_rest_extra\Normalizer;

use Drupal\file\Entity\File;
use Drupal\Core\Site\Settings;
use Drupal\taxonomy\Entity\Term;
use Drupal\Component\Utility\Html;

use Drupal\paragraphs\Entity\Paragraph;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Language\LanguageInterface;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

use Drupal\webcomposer_rest_extra\ExposedFiltersTrait;
use Drupal\serialization\Normalizer\ContentEntityNormalizer;

/**
 * Converts typed data objects to arrays.
 */
class NodeEntityNormalizer extends ContentEntityNormalizer {
  use FilterHtmlTrait;
  use ExposedFiltersTrait;

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = []) {
    $entityData = $entity->toArray();
    $attributes = parent::normalize($entity, $format, $context);

    // add aliases for nodes

    if (isset($entityData['nid'][0]['value'])) {
      $nid = $entityData['nid'][0]['value'];

      $alias = \Drupal::service('path.alias_manager')->getAliasByPath("/node/$nid");
      $attributes['alias'][0]['value'] = $alias;
    }

    // add parent for taxonomy terms

    if (isset($entityData['tid'][0]['value'])) {
      $tid = $entityData['tid'][0]['value'];
      $parent = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadParents($tid);

      if (!empty($parent)) {
        $parent_id = array_keys($parent);
        $attributes['parent'] = $this->loadTermById($parent_id[0]);
      }
    }

    // get exposed filters for draggable weights

    $exposedFilters = [];
    if (isset($context['views_style_plugin'])) {
      $exposedFilters = $this->getExposedFilters($context['views_style_plugin']->view);
    }

    foreach ($entityData as $key => $value) {
      // replace the images src for text formats
      if (isset($value[0]['format'])) {
        if (!empty($value[0]['value'])) {
          $attributes[$key][0]['value'] = $this->filterHtml($attributes[$key][0]['value']);
        }
      }

      if (isset($value[0]['target_id'])) {
        $targetId = $value[0]['target_id'];
        $setting = $entity->get($key)->getSettings();

        switch ($setting['target_type']) {
          case 'paragraph':
            foreach ($value as $id => $item) {
              $attributes[$key][$id] = $this->loadParagraphById($item['target_id']);
            }
            break;

          case 'taxonomy_term':
            foreach ($value as $id => $item) {
              $term = $this->loadTermById($item['target_id'], $entityData, $exposedFilters);

              if ($term === false) {
                unset($attributes[$key][$id]);
              } else {
                $attributes[$key][$id] = $term;
              }
            }
            break;

          case 'node':
            foreach ($value as $id => $item) {
              $attributes[$key][$id] = $this->loadNodeById($item['target_id']);
            }
            break;
        }
      }
    }

    return $attributes;
  }

  /**
   * Load Paragraph by ID
   */
  private function loadParagraphById($id) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
    $paragraph = \Drupal::entityManager()->getStorage('paragraph')->load($id);
    $paragraphTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($paragraph, $lang);
    $pargraphTranslatedArray = $paragraphTranslated->toArray();

    foreach ($pargraphTranslatedArray as $field => $item) {
      $setting = $paragraphTranslated->get($field)->getSettings();

      if (isset($setting['target_type'])) {
        if ($setting['target_type'] == 'file') {
          $field_array = array_merge($pargraphTranslatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
          $pargraphTranslatedArray[$field] = $field_array;
        }
      }

      foreach ($item as $key => $value) {
        if (isset($value['format'])) {
          $field_array = $this->filterHtml($value['value']);
          $pargraphTranslatedArray[$field][$key]['value'] = $field_array;
        }
      }
    }

    return $pargraphTranslatedArray;
  }

  /**
   * Load terms by taxonomy ID
   */
  private function loadTermById($tid, $entityData = [], $exposedFilters = []) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
    $term = Term::load($tid);

    if (!$term) {
      return false;
    }

    $termTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
    $translatedArray = $termTranslated->toArray();

    // Add path to term data

    $term_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/taxonomy/term/' . $tid);
    $translatedArray['path'] = $term_alias;

    foreach ($translatedArray as $field => $item) {
      $setting = $termTranslated->get($field)->getSettings();

      if (isset($setting['target_type'])) {
        if ($setting['target_type'] == 'file' && isset($translatedArray[$field][0])) {
          $field_array = array_merge($translatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
          $translatedArray[$field] = $field_array;
        }
      }
    }

    $nid = $entityData['nid'][0]['value'] ?? null;

    if (is_null($nid)) {
      $nid = $entityData['id'][0]['value'] ?? null;
    }

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
            $translatedArray['field_draggable_views'][$value['identifier']] = $weight;
            break;
          }
        }
      }
    }

    $parent = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadParents($tid);

    if (!empty($parent)) {
      $parent_id = array_keys($parent);
      $translatedArray['parent'] = $this->loadTermById($parent_id[0]);
    }

    return $translatedArray;
  }

  /**
   * Load node data by Node ID
   */
  private function loadNodeById($id) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId();
    $node = \Drupal::entityManager()->getStorage('node')->load($id);

    if ($node) {
        $nodeTranslated = \Drupal::service('entity.repository')->getTranslationFromContext($node, $lang);

        if ($nodeTranslated->isPublished()) {
            $nodeTranslatedArray = $nodeTranslated->toArray();

            foreach ($nodeTranslatedArray as $field => $item) {
                $setting = $nodeTranslated->get($field)->getSettings();

                if (isset($setting['target_type'])) {
                    if ($setting['target_type'] == 'file') {
                        $field_array = array_merge($nodeTranslatedArray[$field][0], $this->loadFileById($item[0]['target_id']));
                        $nodeTranslatedArray[$field] = $field_array;
                    }
                }
            }
        }

        return $nodeTranslatedArray;
    }
  }

  /**
   * Load file url data by target ID
   */
  private function loadFileById($fid) {
    $result = [];
    $fileArray = [];

    if (isset($fid)) {
      $file = File::load($fid);

      if ($file) {
        $fileArray = $file->toArray();
        $fileArray['url'] = file_create_url($file->getFileUri());
      }
    }

    $result[] = $fileArray;

    return $result;
  }
}
