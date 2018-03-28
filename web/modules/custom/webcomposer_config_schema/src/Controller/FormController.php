<?php

namespace Drupal\webcomposer_config_schema\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Url;
use Drupal\Core\Link;
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
    $base = [];

    $class = $this->entity['class'];
    $form = \Drupal::service('form_builder')->getForm($class);

    if (\Drupal::service('webcomposer_config_schema.schema')->isConfigValueOverride()) {
      $message = $this->getInfoMessage();

      $base['message'] = [
        '#theme' => 'status_messages',
        '#message_list' => [
          'warning' => [$message],
        ],
      ];

      $main = reset($form['#editable_config_names']);
      $language = $this->languageManager->getCurrentLanguage();
      $values = \Drupal::service('webcomposer_config_schema.schema')->getConfigValuesByLanguage($main, $language->getId());

      if (empty($values)) {
        $message = "The translation for this language is still empty. It is still using default language values.";

        $base['untranslated'] = [
          '#theme' => 'status_messages',
          '#message_list' => [
            'error' => [$message],
          ],
          '#attributes' => ['style' => 'margin-top: 9px;']
        ];
      }
    }

    return [
      'form' => $base + $form
    ];
  }

  /**
   *
   */
  private function getInfoMessage() {
    $lang = \Drupal::service('language_manager')->getCurrentLanguage()->getName();
    $language = \Drupal::service('language_manager')->getDefaultLanguage();

    $id = $this->entity['id'];

    $uri = new Url("webcomposer_config_schema.form_{$id}", [], [
      'language' => $language,
    ]);

    $link = Link::fromTextAndUrl(t('Cancel translating'), $uri)->toString();

    return t("You are translating this configuration to language <strong>$lang</strong>. Go back by <strong>$link</strong>");
  }
}
