<?php

namespace Drupal\webcomposer_rest_extra\Plugin\views\style;

use Drupal\Component\Utility\Html;
use Drupal\Core\Site\Settings;
use Drupal\file\Entity\File;
use Drupal\rest\Plugin\views\style\Serializer;
use Drupal\Core\Form\FormStateInterface;

use Drupal\webcomposer_rest_extra\PagerTrait;

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
  use PagerTrait;

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['formats'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Accepted request formats'),
      '#description' => $this->t('Request formats that will be allowed in responses. If none are selected all formats will be allowed.'),
      '#options' => $this->getFormatOptions(),
      '#default_value' => $this->options['formats'],
    ];

    $form['pager'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Add pager information'),
      '#description' => $this->t('Pager information will be added to rest export. <b>Output struture will be changed.</b>'),
      '#default_value' => $this->options['pager'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];

    if ($pager = $this->pagerDetails($this->view->pager)) {
      $rows = $pager;

      // Get the content type configured in the display or fallback to the
      // default.
      if ((empty($this->view->live_preview))) {
        $content_type = $this->displayHandler->getContentType();
      } else {
        $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
      }

      return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
    } else {
      $rows = [];
      foreach ($this->view->result as $row_index => $row) {
        $this->view->row_index = $row_index;
        $rows[] = $this->view->rowPlugin->render($row);
      }
      unset($this->view->row_index);

      // Get the content type configured in the display or fallback to the
      // default.
      if ((empty($this->view->live_preview))) {
        $content_type = $this->displayHandler->getContentType();
      } else {
        $content_type = !empty($this->options['formats']) ? reset($this->options['formats']) : 'json';
      }

      $pager = $this->view->pager;
      if ($this->options['pager'] && $pager && $this->displayHandler && get_class($this->displayHandler) === 'Drupal\rest\Plugin\views\display\RestExport') {
        $class = get_class($pager);
        $current_page = $pager->getCurrentPage();
        $items_per_page = $pager->getItemsPerPage();
        $total_items = $pager->getTotalItems();

        $total_pages = 0;
        if(!in_array($class, ['Drupal\views\Plugin\views\pager\None', 'Drupal\views\Plugin\views\pager\Some'])){
          $total_pages = $pager->getPagerTotal();
        }
        $result = [
          'data' => $rows,
          'pagination' => [
            'current_page' => $current_page,
            'total_items' => $total_items,
            'total_pages' => $total_pages,
            'items_per_page' => $items_per_page,
          ],
        ];
        return $this->serializer->serialize($result, $content_type, ['views_style_plugin' => $this]);
      }
      
      return $this->serializer->serialize($rows, $content_type, ['views_style_plugin' => $this]);
    }
  }
}
