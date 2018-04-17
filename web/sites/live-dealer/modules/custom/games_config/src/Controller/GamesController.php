<?php

namespace Drupal\games_config\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Html;

/**
 * Provides route responses for the Game module
 */
class GamesController extends ControllerBase {

    public function getList(Request $request) {
        return [
            '#type' => 'markup',
            '#markup' => "",
        ];
    }
}
