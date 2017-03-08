<?php

namespace Drupal\webcomposer_token\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 *
 */
class WebComposerTokenController extends ControllerBase {

  /**
   *
   */
  public function list() {

    $token_tree = \Drupal::service('token.tree_builder')->buildAllRenderable([
      'click_insert' => FALSE,
      'show_restricted' => TRUE,
      'show_nested' => FALSE,
    ]);

    foreach($token_tree['#token_tree'] as $tokenType => $tokenArray){

      $name = is_null($tokenArray['name']) ? $tokenArray['needs-data'] : $tokenArray['name'];
      foreach($tokenArray['tokens'] as $index => $value) {
        $allTokens[$tokenType][$index] = \Drupal::service('token')->replace($index);
      }
    }

    return new JsonResponse($allTokens);
  }
}
