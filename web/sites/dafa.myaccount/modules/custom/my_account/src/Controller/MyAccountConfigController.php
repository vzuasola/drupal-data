<?php

namespace Drupal\my_account\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
//use Drupal\Core\Link;
//use Drupal\Core\Url;

/**
 * Controller routines for node_type_example.
 *
 * @ingroup node_type_example
 */
class MyAccountConfigController extends ControllerBase {

  /**
   * A simple controller method to explain what this module is about.
   */
  public function api() {

    return new JsonResponse([]);

  }

  /**
   * A simple controller method to explain what this module is about.
   */
  public function admin() {

    return new Response('asd');

  }

}
