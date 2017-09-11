<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Url;

/**
 * Field settings
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class ManageField extends FormBase {
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
      $container->get('current_route_match')
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
    if (!$this->entity && !$this->field) {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    $this->generateSettingsForm($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   * Generates the settings form
   */
  protected function generateSettingsForm(&$form) {
    $name = $this->getDefaultConfigName();

    $form['field_settings'] = [
      '#type' => 'details',
      '#title' => 'Field Settings',
      '#open' => TRUE,
    ];

    foreach ($this->field->getSettings() as $key => $value) {
      $form['field_settings'][$key] = $value;

      $defaultValue = $this->getConfigValues($name, $key);
      $defaultDefinedValue = $this->field->getOption('default_value');

      if (isset($defaultValue)) {
        $form['field_settings'][$key]['#default_value'] = $defaultValue;
      } elseif ($defaultDefinedValue) {
        $form['field_settings'][$key]['#default_value'] = $defaultDefinedValue;
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
