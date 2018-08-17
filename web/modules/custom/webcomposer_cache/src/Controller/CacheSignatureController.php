<?php

namespace Drupal\webcomposer_cache\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for System routes.
 */
class CacheSignatureController extends ControllerBase {

  public function regenerate() {
    \Drupal::service('webcomposer_cache.signature_manager')->renewSignature();

    drupal_set_message('A new Redis Signature has been generated.');
  }
}
