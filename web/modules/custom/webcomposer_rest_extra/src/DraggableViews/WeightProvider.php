<?php

namespace Drupal\webcomposer_rest_extra\DraggableViews;

class WeightProvider {
  public function getWeight($view_name, $view_display, $args, $entity_id) {
    $data = \Drupal::database()->select('draggableviews_structure', 'u')
      ->fields('u')
      ->condition('u.view_name', $view_name)
      ->condition('u.view_display', $view_display)
      ->condition('u.args', json_encode($args))
      ->condition('u.entity_id', $entity_id)
      ->execute()
      ->fetchAssoc();

    if (isset($data['args'])) {
      $data['args'] = json_decode($data['args'], true);
    }

    return $data;
  }
}
