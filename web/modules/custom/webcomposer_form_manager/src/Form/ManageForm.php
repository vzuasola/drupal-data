<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;

/**
 * Class List.
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class ManageForm extends FormBase {
  private $formManager;
  private $route;

  /**
   * Class constructor.
   */
  public function __construct($typedConfigManager, $languageManager, $formManager, $route) {
    parent::__construct($typedConfigManager, $languageManager);

    $this->formManager = $formManager;
    $this->route = $route;

    $this->entity = $this->getEntity();
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
  public function title() {
    $name = $this->entity->getName();

    return $name;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager'),
      $container->get('webcomposer_form_manager.form_manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    $id = $this->entity->getId();

    return [
      "webcomposer_form_manager.form.$id"
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigName() {
    $id = $this->entity->getId();

    return "webcomposer_form_manager.form.$id";
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_form_manager.manage_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // check if the entity exists first
    if (!$this->entity) {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    $this->generateSettingsForm($form);
    $this->generateFieldsForm($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   * Generates the settings form
   */
  protected function generateSettingsForm(&$form) {
    $name = $this->getDefaultConfigName();
    $settings = $this->entity->getSettings();

    if (!empty($settings)) {
      $form['form_settings'] = [
        '#type' => 'details',
        '#title' => 'Form Settings',
        '#open' => TRUE,
      ];

      foreach ($settings as $key => $value) {
        $form['form_settings'][$key] = $value;

        $defaultValue = $this->getConfigValues($name, $key);
        if (isset($defaultValue)) {
          $form['form_settings'][$key]['#default_value'] = $defaultValue;
        }
      }
    }
  }

  /**
   * Generates the settings form
   */
  protected function generateFieldsForm(&$form) {
    $id = $this->entity->getId();
    $name = $this->getDefaultConfigName();
    $fields = $this->entity->getFields();

    $i = 0;
    $header = ['Name', 'Field type', 'Actions', 'Weight'];

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#empty' => 'No form to show',
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'mytable-order-weight',
        ],
      ],
    ];

    foreach ($fields as $key => $field) {
      $url = new Url('webcomposer_form_manager.field.view', [
        'form' => $id,
        'field' => $field->getId(),
      ]);

      $weight = ++ $i;

      $form['table'][$key]['title'] = [
        '#markup' => $field->getName(),
      ];

      $form['table'][$key]['type'] = [
        '#markup' => ucwords($field->getType()),
      ];

      if ($field->getSettings()) {
        $form['table'][$key]['actions'] = [
          '#markup' => $this->l('Edit', $url),
        ];
      } else {
        $form['table'][$key]['actions'] = [
          '#markup' => 'No actions',
        ];
      }

      $form['table'][$key]['weight'] = [
        '#type' => 'weight',
        '#title' => 'Weight',
        '#title_display' => 'invisible',
        '#default_value' => $weight,
        '#attributes' => ['class' => ['mytable-order-weight']],
      ];

      $form['table'][$key]['#attributes'] = ['class' => ['draggable']];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   *
   * @todo Add saving of field orders here
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $name = $this->getDefaultConfigName();

    $settings = $this->entity->getSettings();
    $keys = array_keys($settings);

    $this->saveConfigValues($name, $keys, $form_state);
  }
}
