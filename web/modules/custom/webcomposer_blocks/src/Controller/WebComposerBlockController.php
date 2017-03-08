<?php

namespace Drupal\webcomposer_blocks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 *
 */
class WebComposerBlockController extends ControllerBase {

  /**
   *
   */
  public function getIDbyUUID($uuid) {

    $ids = \Drupal::entityQuery('block_content')->condition('uuid', $uuid)->execute();
    if (null != $ids) {
        return new JsonResponse([$uuid => array_pop($ids)]);
    }
    return new JsonResponse([]);
  }
}
