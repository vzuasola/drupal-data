<?php

/**
 * @file
 * Contains Drupal\webcomposer_token\Controller\WebComposerTokenController
 */

namespace Drupal\webcomposer_token\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Provides a class that handles customized token extensions for web composer
 * Requires the Token Module
 *
 */
class WebComposerTokenController extends ControllerBase {

 /**
   * function that would get all available tokens. Its based on the listing from /admin/help/token
   */
  public function list() {

    $token_tree = \Drupal::service('token.tree_builder')->buildAllRenderable([
      'click_insert' => FALSE,
      'show_restricted' => TRUE,
      'show_nested' => FALSE,
      'recursion_limit' => 3
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
