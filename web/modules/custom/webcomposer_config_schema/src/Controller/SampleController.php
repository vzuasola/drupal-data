<?php

namespace Drupal\webcomposer_config_schema\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Base class for entity translation controllers.
 */
class SampleController extends ControllerBase {
  /**
   *
   */
  public function title() {
    return 'Alex';
  }

  /**
   *
   */
  public function translate() {

    $build = [
      '#markup' => 'Hello World',
    ];

    return $build;
  }
}
