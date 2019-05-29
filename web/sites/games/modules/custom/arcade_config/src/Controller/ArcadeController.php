<?php

namespace Drupal\arcade_config\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Html;

/**
 * Provides route responses for the Example module.
 */
class ArcadeController extends ControllerBase {

    public function placeholder(Request $request) {
        return array(
            '#type' => 'markup',
            '#markup' => "",
        );
    }

}
