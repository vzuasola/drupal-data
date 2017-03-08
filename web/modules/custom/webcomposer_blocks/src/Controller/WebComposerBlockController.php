<?php

/**
 * @file
 * Contains Drupal\webcomposer_blocks\Controller\WebComposerBlockController
 */

namespace Drupal\webcomposer_blocks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Provides a class that handles customized block extensions for web composer
 *
 */
class WebComposerBlockController extends ControllerBase {

  /**
   * function that would get the id of the block content using the corresponding UUID given by a rest entity call
   * @param string $uuid
   *   the uuid based from a call from /entity/block/{block}?_format=json
   */
  public function getIDbyUUID($uuid) {

    $ids = \Drupal::entityQuery('block_content')->condition('uuid', $uuid)->execute();
    if (null != $ids) {
        return new JsonResponse([$uuid => array_pop($ids)]);
    }
    return new JsonResponse([]);
  }
}
