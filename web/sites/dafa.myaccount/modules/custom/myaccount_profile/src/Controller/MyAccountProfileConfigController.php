<?php

namespace Drupal\myaccount_profile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Controller routines for node_type_example.
 *
 * @ingroup node_type_example
 */
class MyAccountProfileConfigController extends ControllerBase {

  /**
   * A simple controller method to explain what this module is about.
   */
  public function api() {

    $config = \Drupal::config('myaccount_profile.my_profile');
    $values = $config->get();
    return new JsonResponse( $values);
  }
}
