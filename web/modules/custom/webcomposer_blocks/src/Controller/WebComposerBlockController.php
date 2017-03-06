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
  public function getUUIDbyID($id) {

    $ids = \Drupal::entityQuery('block_content')->condition('uuid', $id)->execute();
    if (null != $ids) {
        return new JsonResponse([$id => array_pop($ids)]);
    }
    return new JsonResponse([]);
  }
}
