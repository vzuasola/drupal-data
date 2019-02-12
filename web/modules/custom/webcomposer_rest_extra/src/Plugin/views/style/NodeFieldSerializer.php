<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;

use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\file\Entity\File;
use Drupal\rest\Plugin\views\style\Serializer;

/**
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "node_field_serializer",
 *   title = @Translation("Node Field Serializer"),
 *   help = @Translation("Custom serializer for the node field that exposes content links"),
 *   display_types = {"data"}
 * )
 */
class NodeFieldSerializer extends Serializer {

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];

    foreach ($this->view->result as $row_index => $row) {
      $this->view->row_index = $row_index;
      
      $dataFieldRows = [];
      foreach ($this->view->rowPlugin->render($row) as $fieldName => $fieldValue) {
        switch ($fieldName) {
          case 'type':
            $dataFieldRows[$fieldName] = $this->fieldValueFormatter($fieldValue, 'target_id');
            break;
          
          default:
            $dataFieldRows[$fieldName] = $this->fieldValueFormatter($fieldValue);
            break;
        }
      }

      // Adds field alias
      if (isset($dataFieldRows['nid'])) {
        $alias = \Drupal::service('path.alias_manager')
          ->getAliasByPath('/node/' . $dataFieldRows['nid'][0]['value']);
        $dataFieldRows['alias'] = $this->fieldValueFormatter($alias);
      }

      $rows[] = $dataFieldRows;
    }

    unset($this->view->row_index);

    if ((empty($this->view->live_preview))) {
      $content_type = $this->displayHandler->getContentType();
    } else {
      $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
    }

    return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
  }

  /**
   * {@inheritdoc}
   */
  private function fieldValueFormatter($fieldValue, $key = 'value')
  {
    return [
      [$key => $fieldValue],
    ];
  }
}
