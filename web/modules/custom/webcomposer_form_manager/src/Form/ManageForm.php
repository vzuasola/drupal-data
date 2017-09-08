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
    return "Webcomposer Form: {$this->entity->getName()}";
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

    // $name = $this->getDefaultConfigName();

    // $form['javascript_assets'] = array(
    //   '#type' => 'textarea',
    //   '#title' => t('Javascript Assets'),
    //   '#size' => 500,
    //   '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
    //   '#default_value' => $this->getConfigValues($name, 'javascript_assets')
    // );

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

    $form['form_settings'] = [
      '#type' => 'details',
      '#title' => 'Form Settings',
      '#open' => FALSE,
    ];

    foreach ($settings as $key => $value) {
      $form['form_settings'][$key] = $value;

      $defaultValue = $this->getConfigValues($name, $key);
      if (isset($defaultValue)) {
        $form['form_settings'][$key]['#default_value'] = $defaultValue;
      }
    }
  }

  /**
   * Generates the settings form
   */
  protected function generateFieldsForm(&$form) {
    $name = $this->getDefaultConfigName();
    $fields = $this->entity->getFields();

    foreach ($fields as $key => $value) {
      $url = new Url('webcomposer_form_manager.form.view', ['form' => $key]);

      $rows[] = [
        'title' => $value['#title'],
        'type' => $value['#type'],
        'actions' => $this->l('Edit', $url),
        'weight' => [
          '#type' => 'weight',
          '#title' => 'Weight',
          '#title_display' => 'invisible',
          '#default_value' => 0,
          '#attributes' => ['class' => ['webcomposer-form-manager-weight']],
        ],
      ];
    }

    // $rows[] = [
    //   'data' => $row,
    //   'class' => ['draggable'],
    // ];

    $header = [
      'name' => 'Name',
      'type' => 'Field type',
      'actions' => 'Actions',
    ];

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => 'No form to show',

      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'mytable-order-weight',
        ],
      ],

      '#attributes' => [
        'id' => 'webcomposer-form-manager-fields',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $name = $this->getDefaultConfigName();

    $settings = $this->entity->getSettings();
    $keys = array_keys($settings);

    $this->saveConfigValues($name, $keys, $form_state);
  }
}
