<?php

namespace Drupal\casino_games\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Html;

/**
 * Provides route responses for the Example module.
 */
class GamesController extends ControllerBase {

	public function getList(Request $request) {
	    return array(
	      '#type' => 'markup',
	      '#markup' => "",
	    );
  	}

}