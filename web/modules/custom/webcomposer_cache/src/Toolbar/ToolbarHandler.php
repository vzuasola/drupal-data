<?php

namespace Drupal\webcomposer_cache\Toolbar;

use Drupal\Core\Url;

class ToolbarHandler {
  public function generateToolbar() {
    $build = [];

    if (\Drupal::service('router')->getRouteCollection()->get('webcomposer_cache.new_signature')) {
      $build['link'] = [
        '#type' => 'link',
        '#title' => t('Generate New Signature'),
        '#url' => Url::fromRoute('webcomposer_cache.new_signature', [
          'destination' => Url::fromRoute('<current>')->toString(),
        ]),
      ];
    }

    return $build;
  }
}
