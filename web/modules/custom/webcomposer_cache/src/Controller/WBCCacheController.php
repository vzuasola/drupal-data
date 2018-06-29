<?php

namespace Drupal\webcomposer_cache\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for System routes.
 */
class WBCCacheController extends ControllerBase
{
    public function rengenerateSignature()
    {
        \Drupal::service('webcomposer_cache.signature_manager')->renewSignature();

        drupal_set_message('A new Redis Signature has been generated.');
    }
}
