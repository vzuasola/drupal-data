<?php

namespace Drupal\webcomposer_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for System routes.
 */
class CacheActionController extends ControllerBase {
  public function clearCache() {
    drupal_flush_all_caches();

    drupal_set_message('All caches had been cleared.');
    return $this->redirect('<front>');
  }
}
