<?php

namespace Drupal\arcade_config\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides route responses for the Example module.
 */
class DefaultController extends ControllerBase
{
    public function placeholder(Request $request)
    {
        return array(
            '#type' => 'markup',
            '#markup' => "",
        );
    }
}
