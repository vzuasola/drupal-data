<?php

namespace Drupal\webcomposer_config_schema\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Base class for entity translation controllers.
 */
class TranslateController extends ControllerBase {
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
      if ($path === "admin/config/$key/translate/$key") {
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
  public function translate() {
    $header = [
      $this->t('Language'),
      $this->t('Status'),
      $this->t('Operations'),
    ];

    $default = $this->languageManager->getDefaultLanguage();
    $languages = $this->languageManager->getLanguages();
    $rows = [];

    $class = $this->entity['class'];
    $form = \Drupal::service('form_builder')->getForm($class);

    $main = reset($form['#editable_config_names']);

    foreach ($languages as $language) {
      $name = $language->getName();

      $id = $this->entity['id'];

      $uri = new Url("webcomposer_config_schema.form_{$id}", [
        'language' => $language->getId(),
      ], [
        'language' => $language,
      ]);

      // check if values are published or not

      $status = 'Empty';
      $values = \Drupal::service('webcomposer_config_schema.schema')->getConfigValuesByLanguage($main, $language->getId());

      if (!empty($values)) {
        $status = 'Published';
      }

      $operations = [
        'data' => [
          '#type' => 'operations',
          '#links' => [
            'edit' => [
              'url' => $uri,
              'language' => $language,
              'title' => 'Edit'
            ],
          ],
        ],
      ];

      $rows[] = [
        $name,
        $status,
        $operations,
      ];
    }

    $build['translation'] = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];

    return $build;
  }
}
