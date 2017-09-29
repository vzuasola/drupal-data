<?php

namespace Drupal\webcomposer_form_manager\Controller;

use Drupal\content_translation\ContentTranslationManagerInterface;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base class for entity translation controllers.
 */
class ManageFieldController extends ControllerBase {
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('language_manager'),
      $container->get('webcomposer_form_manager.form_manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * Class constructor.
   */
  public function __construct($languageManager, $formManager, $route) {
    $this->languageManager = $languageManager;
    $this->formManager = $formManager;
    $this->route = $route;

    $this->entity = $this->getEntity();
    $this->field = $this->getField();
  }

  /**
   *
   */
  private function getEntity() {
    $entityId = $this->route->getParameter('form');
    $entity = $this->formManager->getFormById($entityId);

    return $entity;
  }

  /**
   *
   */
  private function getField() {
    $fieldId = $this->route->getParameter('field');
    $field = $this->entity->getField($fieldId);

    return $field;
  }

  /**
   * 
   */
  public function title() {
    return $this->entity->getName();
  }

  /**
   * Translate overview page
   *
   * @param RouteMatchInterface $route_match
   */
  public function translate(RouteMatchInterface $route_match) {
    $header = [
      $this->t('Language'),
      $this->t('Status'),
      $this->t('Operations'),
    ];

    $languages = $this->languageManager->getLanguages();
    $rows = [];

    foreach ($languages as $language) {
      $languageName = $language->getName();
      $status = 'Published';

      $uri = new Url('webcomposer_form_manager.field.view', [
        'form' => $this->route->getParameter('form'),
        'field' => $this->route->getParameter('field'),
        'language' => $language->getId(),
      ], [
        'language' => $language,
      ]);

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
        $languageName,
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
