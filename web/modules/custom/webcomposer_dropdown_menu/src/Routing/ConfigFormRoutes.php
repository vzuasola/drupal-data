<?php

namespace Drupal\webcomposer_dropdown_menu\Routing;

use Symfony\Component\Routing\Route;

class ConfigFormRoutes {
    /**
     * 
     */
    public function getRoutes() {
      $routes = [];
      
      $manager = \Drupal::service('webcomposer_dropdown_menu.dropdown_menu_manager');
      $sections = $manager->getSections();

      foreach ($sections as $section => $definition) {
        if (isset($definition['class'])) {
          $routename = "webcomposer_dropdown_menu.{$section}_form";
          $routeURI = "admin/config/webcomposer/dropdown/manage/$section";

          $routes[$routename] = new Route(
            $routeURI,
            [
              '_form' => $definition['class'],
              '_title' => $definition['name'],
            ],
            [
              '_permission'  => 'administer site configuration',
            ]
          );
        }
      }

      return $routes;
    }
}
