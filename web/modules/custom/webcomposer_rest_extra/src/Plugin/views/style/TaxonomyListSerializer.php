<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;

use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\file\Entity\File;
use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\webcomposer_rest_extra\FilterHtmlTrait;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "taxonomy_list_serializer",
 *   title = @Translation("Taxonomy List Serializer"),
 *   help = @Translation("Custom serializer for the node list that exposes taxonomy terms references"),
 *   display_types = {"data"}
 * )
 */
class TaxonomyListSerializer extends Serializer {
  use FilterHtmlTrait;
  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];

    foreach ($this->view->result as $row_index => $row) {
      $this->view->row_index = $row_index;
      // converting current row into array
      $rowAssoc = $this->serializer->normalize($this->view->rowPlugin->render($row));

      $tid = $rowAssoc['tid'][0]['value'];

      $parent = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadParents($tid);
      $rowAssoc['parent'] = array_values($parent);

      $parent_id = array_keys($parent);

      $rowAssoc['parent'] = $this->loadTerm($parent_id);

      $rows[] = $rowAssoc;
    }

    unset($this->view->row_index);

    // Get the content type configured in the display or fallback to the
    // default.
    if ((empty($this->view->live_preview))) {
      $content_type = $this->displayHandler->getContentType();
    } else {
      $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
    }

    return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
  }

  private function loadTerm($tid) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();

    $term = \Drupal\taxonomy\Entity\Term::load($tid[0]);
    $term_translated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);
    $term_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/taxonomy/term/' . $tid[0]);
    $term_translated->set('path', $term_alias);
    return $term_translated;
  }
}
