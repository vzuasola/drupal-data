<?php

namespace Drupal\webcomposer_cache\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

/**
 * Returns responses for System routes.
 */
class CacheSignatureController extends ControllerBase {
  public function regenerate() {
    $signature = \Drupal::service('webcomposer_cache.signature_manager')->renewSignature();
    $signature = strtoupper($signature);

    drupal_set_message(
      Markup::create("
        A new Redis Signature has been generated with a new signature of <strong>$signature</strong>.
      ")
    );

    return $this->redirect('<front>');
  }
}
