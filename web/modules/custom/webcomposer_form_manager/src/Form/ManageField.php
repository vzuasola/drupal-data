<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Field settings
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class ManageField extends FormBase {
  /**
   * Drupal language manager
   *
   * @var object
   */
  protected $languageManager;

  /**
   * Form manager
   *
   * @var \Drupal\webcomposer_form_manager\WebcomposerForm
   */
  private $formManager;

  /**
   * Current Route
   *
   * @var object
   */
  private $route;

  /**
   * Class constructor.
   */
  public function __construct($typedConfigManager, $languageManager, $formManager, $route, $moduleHandler) {
    parent::__construct($typedConfigManager, $languageManager, $moduleHandler);

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
    $field = $this->field->getName();

    return $field;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager'),
      $container->get('webcomposer_form_manager.form_manager'),
      $container->get('current_route_match'),
      $container->get('module_handler')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    $id = $this->entity->getId();
    $field = $this->field->getId();

    return [
      "webcomposer_form_manager.form.$id.$field"
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigName() {
    $id = $this->entity->getId();
    $field = $this->field->getId();

    return "webcomposer_form_manager.form.$id.$field";
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_form_manager.manage_field';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // check if the entity and field exists first
    switch (true) {
      case !$this->entity:
      case !$this->field:
      case empty($this->field->getSettings()):
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    // display helpful message to remind editors that they are translating a value
    if ($this->isConfigValueOverride()) {
      $this->notify();
    }

    $this->generateSettingsForm($form);
    $this->generateValidationsForm($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   * Notify user that the form is a translate form
   */
  private function notify() {
    $id = $this->entity->getId();
    $field = $this->field->getId();

    $lang = $this->languageManager->getCurrentLanguage()->getId();
    $language = $this->languageManager->getDefaultLanguage();

    $uri = new Url('webcomposer_form_manager.field.view', [
      'form' => $id,
      'field' => $field,
      'language' => $language->getId(),
    ], [
      'language' => $language,
    ]);

    $link = Link::fromTextAndUrl(t('Cancel translating'), $uri)->toString();

    drupal_set_message(t("You are translating this configuration to language <strong>$lang</strong>. Go back by <strong>$link</strong>"), 'warning');
  }

  /**
   * Generates the settings form
   */
  protected function generateSettingsForm(&$form) {
    $name = $this->getDefaultConfigName();
    $fieldSettings = $this->getConfigValues($name, 'field_settings');

    $form['field_settings'] = [
      '#type' => 'details',
      '#title' => 'Field Settings',
      '#open' => TRUE,
      '#tree' => TRUE,
    ];

    foreach ($this->field->getSettings() as $key => $value) {
      $form['field_settings'][$key] = $value;

      $defaultValue = $this->field->getOption('default_value');

      if (isset($fieldSettings[$key])) {
        $form['field_settings'][$key]['#default_value'] = $fieldSettings[$key];
      } elseif ($defaultValue) {
        $form['field_settings'][$key]['#default_value'] = $defaultValue;
      }
    }
  }

  /**
   * Generates the validation form
   */
  protected function generateValidationsForm(&$form) {
    $name = $this->getDefaultConfigName();
    $fieldValidations = $this->getConfigValues($name, 'field_validations');

    $form['field_validations'] = [
      '#type' => 'vertical_tabs',
      '#title' => 'Configure validation for this field',
      '#tree' => TRUE,
    ];

    $validations = $this->formManager->getValidations();

    foreach ($validations as $key => $value) {
      $form[$key] = [
        '#type' => 'details',
        '#title' => $value['title'],
        '#group' => 'field_validations',
        '#tree' => TRUE,
      ];

      $form[$key]['enable'] = [
        '#type' => 'checkbox',
        '#title' => $value['title'],
        '#description' => $value['description'],
        '#parents' => ['field_validations', $key, 'enable'],
        '#default_value' => $fieldValidations[$key]['enable'] ?? FALSE,
      ];

      $form[$key]['error_wrapper'] = [
        '#type' => 'details',
        '#title' => 'Error message',
        '#open' => TRUE,
      ];

      $form[$key]['error_wrapper']['error_message'] = [
        '#type' => 'textarea',
        '#title' => 'Error Message',
        '#description' => "Provides the default error message for this validation set",
        '#parents' => ['field_validations', $key, 'error_message'],
        '#default_value' => $fieldValidations[$key]['error_message'] ?? $value['error'] ?? "",
      ];

      if (!empty($value['parameters'])) {
        $form[$key]['parameters_wrapper'] = [
          '#type' => 'details',
          '#title' => 'Parameters',
          '#open' => TRUE,
          '#parents' => ['field_validations', $key, 'parameters'],
        ];

        foreach ($value['parameters'] as $paramKey => $paramValue) {
          $form[$key]['parameters_wrapper'][$paramKey] = $paramValue;

          if (isset($fieldValidations[$key]['parameters'][$paramKey])) {
            $form[$key]['parameters_wrapper'][$paramKey]['#default_value'] = $fieldValidations[$key]['parameters'][$paramKey];
          }
        }
      }

      // disable translation for the following fields
      if ($this->isConfigValueOverride()) {
        $form[$key]['enable']['#disabled'] = TRUE;
        $form[$key]['parameters_wrapper']['#disabled'] = TRUE;

        $defaultValidations = $this->getDefaultConfigValues($name, 'field_validations');
        $form[$key]['enable']['#default_value'] = $defaultValidations[$key]['enable'] ?? FALSE;
      }
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
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->saveFieldSettings($form, $form_state);
    $this->saveValidations($form, $form_state);

    $id = $this->entity->getId();
    $field = $this->field->getId();
    $language = $this->languageManager->getCurrentLanguage();

    drupal_set_message($this->t("The configuration for field <strong>$field</strong> has been saved."));

    $uri = new Url('webcomposer_form_manager.form.view', [
      'form' => $id,
      'language' => $language->getId(),
    ], [
      'language' => $language,
    ]);

    $form_state->setRedirectUrl($uri);
  }

  /**
   * Save field settings
   */
  protected function saveFieldSettings($form, FormStateInterface $form_state) {
    $name = $this->getDefaultConfigName();
    $before = $this->getConfigValues($name, 'field_settings');
    $settings = $this->field->getSettings();
    $keys = array_keys($settings);

    $data = [];
    $fieldSettings = $form_state->getValue(['field_settings']);

    foreach ($keys as $key) {
      $data[$key] = $fieldSettings[$key];
    }

    $this->saveRawConfigValue($name, 'field_settings', $data);
    $this->moduleHandler->invokeAll('webcomposer_form_config_schema_update', [$name . ".settings", $data, $before]);
  }

  /**
   * Save field validations
   */
  protected function saveValidations($form, FormStateInterface $form_state) {
    $name = $this->getDefaultConfigName();
    $before = $this->getConfigValues($name, 'field_validations');
    $validations = $this->formManager->getValidations();
    $keys = array_keys($validations);

    $data = [];
    $fieldValidations = $form_state->getValue(['field_validations']);

    foreach ($keys as $key) {
      $data[$key] = $fieldValidations[$key];

      // if we are translating a value, do not save the enable flag, so that the
      // enable flag will be fetched from the default language
      if ($this->isConfigValueOverride()) {
        unset($data[$key]['enable']);
        unset($data[$key]['parameters']);
      }
    }

    $this->saveRawConfigValue($name, 'field_validations', $data);
    $this->moduleHandler->invokeAll('webcomposer_form_config_schema_update', [$name . ".validation", $data, $before]);
  }
}
