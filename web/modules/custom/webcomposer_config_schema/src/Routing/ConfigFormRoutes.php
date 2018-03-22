<?php

namespace Drupal\webcomposer_config_schema\Routing;

use Symfony\Component\Routing\Route;

class ConfigFormRoutes {
  /**
   * 
   */
  public function __construct() {
    $this->pluginManager = \Drupal::service('plugin.manager.webcomposer_config_plugin');
  }

  /**
   * 
   */
  public function getRoutes() {
    $routes = [];
    $definitions = $this->pluginManager->getDefinitions();

    foreach ($definitions as $id => $definition) {
      if (isset($definition['route'])) {
        $routename = "webcomposer_config_schema.form_{$id}";
        $routeURI = $definition['route']['path'];

        $routes[$routename] = new Route(
          $routeURI,
          [
            '_controller' => '\Drupal\webcomposer_config_schema\Controller\FormController::form',
            '_title_callback' => '\Drupal\webcomposer_config_schema\Controller\FormController::title',
          ],
          [
            '_permission'  => 'administer site configuration',
          ]
        );

        // $routes[$routename] = new Route(
        //   $routeURI,
        //   [
        //     '_form' => $definition['class'],
        //     '_title' => $definition['route']['title'],
        //   ],
        //   [
        //     '_permission'  => 'administer site configuration',
        //   ]
        // );
      }
    }

    return $routes;
  }
}
