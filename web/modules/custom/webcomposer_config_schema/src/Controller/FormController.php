<?php

namespace Drupal\webcomposer_config_schema\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Controller\ControllerBase;

/**
 * Base class for entity translation controllers.
 */
class FormController extends ControllerBase {
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('language_manager'),
      $container->get('plugin.manager.webcomposer_config_plugin'),
      $container->get('current_route_match')
    );
  }

  /**
   * Class constructor.
   */
  public function __construct($languageManager, $pluginManager, $route) {
    $this->languageManager = $languageManager;
    $this->pluginManager = $pluginManager;
    $this->route = $route;

    $this->entity = $this->getEntity();
  }

  /**
   *
   */
  private function getEntity() {
    $path = $this->route->getCurrentRouteMatch()->getRouteObject()->getPath();
    $path = trim($path, '/');

    $definitions = $this->pluginManager->getDefinitions();

    foreach ($definitions as $key => $definition) {
      if (trim($definition['route']['path'], '/') == $path) {
        return $definition;
      }
    }

    throw new NotFoundHttpException();
  }

  /**
   *
   */
  public function title() {
    return $this->entity['route']['title'];
  }

  /**
   *
   */
  public function form() {
    $class = $this->entity['class'];
    $form = \Drupal::service('form_builder')->getForm($class);

    return [
      'form,' => $form
    ];
  }
}
