<?php

namespace Drupal\webcomposer_dashboard\Toolbar;

use Drupal\Core\Url;

class ToolbarHandler {
  public function generateToolbar() {
    $build = [];

    if (\Drupal::service('router')->getRouteCollection()->get('webcomposer_dashboard.clear_cache')) {
      $build['link'] = [
        '#type' => 'link',
        '#title' => t('Clear Cache'),
        '#url' => Url::fromRoute('webcomposer_dashboard.clear_cache', [
          'destination' => Url::fromRoute('<current>')->toString(),
        ]),
      ];
    }

    return $build;
  }
}
