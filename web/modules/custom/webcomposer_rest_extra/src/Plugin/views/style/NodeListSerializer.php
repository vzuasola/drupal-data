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
 *   id = "node_list_serializer",
 *   title = @Translation("Node List Serializer"),
 *   help = @Translation("Custom serializer for the node list that exposes taxonomy terms references"),
 *   display_types = {"data"}
 * )
 */
class NodeListSerializer extends Serializer {
  use FilterHtmlTrait;

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];

    foreach ($this->view->result as $row_index => $row) {
      $this->view->row_index = $row_index;

      // converting current row into array
      $rowAssoc = $this->serializer->normalize(
        $this->view->rowPlugin->render($row), null, ['view' => $this->view]
      );

      // add aliases on the nodes
      if (isset($row->nid)) {
        $alias = \Drupal::service('path.alias_manager')->getAliasByPath("/node/$row->nid");
        $rowAssoc['alias'][0]['value'] = $alias;
      }

      foreach ($rowAssoc as $key => $value) {
        // replace the images src for text formats
        if (isset($value[0]['format']) && isset($value[0]['value'])) {
            $rowAssoc[$key][0]['value'] = $this->filterHtml($value[0]['value']);
        }

        // loading the term object onto the rest export
        if (isset($value[0]['target_type']) && $value[0]['target_type'] == 'taxonomy_term') {
          $term = $this->loadTerm($value[0]['target_id']);
          $rowAssoc[$key][0] = $term;
        }

        // loading the paragraph object onto the rest export
        foreach ($value as $paragraphKey => $pid) {
          if (isset($pid['target_type']) && $pid['target_type'] == 'paragraph') {
            $rowAssoc[$key][$paragraphKey] = $this->loadParagraphById($pid['target_id']);
          }
        }
      }

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

  /**
   * Load terms by taxonomy ID
   */
  private function loadTerm($tid) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();

    $term = \Drupal\taxonomy\Entity\Term::load($tid);
    $term_translated = \Drupal::service('entity.repository')->getTranslationFromContext($term, $lang);

    $term_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/taxonomy/term/' . $tid);
    $term_translated->set('path', $term_alias);

    return $term_translated;
  }

  /**
   * Load paragraph by paragraph ID
   */
  private function loadParagraphById($id) {
    $lang = \Drupal::languageManager()->getCurrentLanguage(\Drupal\Core\Language\LanguageInterface::TYPE_CONTENT)->getId();
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

      // replace the images src for text formats
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
