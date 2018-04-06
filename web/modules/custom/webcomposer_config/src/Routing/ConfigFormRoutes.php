<?php

namespace Drupal\webcomposer_config\Routing;

use Symfony\Component\Routing\Route;

class ConfigFormRoutes {
  /**
   *
   */
  public function getRoutes() {
    $routes = [];

    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $routes['webcomposer_config.header_configuration_form'] = new Route(
        'admin/config/webcomposer/config/header',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\HeaderConfiguration',
          '_title' => 'Header Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.footer_configuration_form'] = new Route(
        'admin/config/webcomposer/config/footer',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\FooterConfiguration',
          '_title' => 'Footer Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.login_configuration_form'] = new Route(
        'admin/config/webcomposer/config/login',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\LoginConfiguration',
          '_title' => 'Login Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.outdated_browser_configuration_form'] = new Route(
        'admin/config/webcomposer/config/browser',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\OutdatedBrowserConfiguration',
          '_title' => 'Outdated Browser Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.page_not_found_form'] = new Route(
        'admin/config/webcomposer/config/page-not-found',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\PageNotFound',
          '_title' => 'Page Not Found',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.pushnx_configuration_form'] = new Route(
        'admin/config/webcomposer/config/pushnx',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\PushNotificationConfiguration',
          '_title' => 'Push Notification Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.robots_configuration_form'] = new Route(
        'admin/config/webcomposer/config/robots',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\RobotsConfiguration',
          '_title' => 'Robots Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.log_configuration_form'] = new Route(
        'admin/config/webcomposer/config/log',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\LogConfiguration',
          '_title' => 'Log Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );

      $routes['webcomposer_config.curacao_configuration_form'] = new Route(
        'admin/config/webcomposer/config/curacao',
        [
          '_form' => 'Drupal\webcomposer_config\Deprecated\Form\CuracaoConfiguration',
          '_title' => 'Curacao Configuration',
        ],
        [
          '_permission'  => 'administer site configuration',
        ]
      );
    }

    return $routes;
  }
}
