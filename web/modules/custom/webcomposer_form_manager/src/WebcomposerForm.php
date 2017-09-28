<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * Webcomposer Entity Manager
 */
class WebcomposerForm {
  /**
   * The Webcomposer Form Plugin manager
   *
   * @var object
   */
  private $pluginManager;

  /**
   *
   */
  public function __construct($pluginManager)
  {
    $this->pluginManager = $pluginManager;
  }

  /**
   * Returns the list of the forms
   */
  public function getFormList() {
    $result = [];

    foreach ($this->pluginManager->getDefinitions() as $definition) {
      $id = $definition['id'];
      $result[$id]['name'] = $definition['name'];
    }

    return $result; 
  }

  /**
   * Fetch a single form entity instance
   *
   * @param string $id The form ID
   * 
   * @return WebcomposerFormEntity
   */
  public function getFormById($id) {
    $instance = $this->pluginManager->createInstance($id);

    $definition = $instance->getPluginDefinition();

    $id = $definition['id'];
    $name = $definition['name'];
    $fields = $instance->getFields();
    $settings = $instance->getSettings();

    $form = new WebcomposerFormEntity($id, $name, $settings);

    foreach ($fields as $key => $field) {
      $options = isset($field['options']) ? $field['options'] : [];
      $settings = isset($field['settings']) ? $field['settings'] : [];

      $form->setField(new WebcomposerFormFieldEntity(
        $key,
        $field['name'],
        $field['type'],
        $options,
        $settings
      ));
    }

    return $form;
  }

  /**
   * Gets the list of validations
   * 
   * @todo Create an alter hook so modules can alter the validation sets
   * @todo Sync the validation behavior and description with Webform Validations
   *
   * @return array
   */
  public function getValidations() {
    return [
      'required' => [
        'title' => 'Required',
        'description' => 'Make this field required. Does not accept empty string inputs such as nulls and whitespace only.',
        'error' => 'Field should be required',
      ],
      'alphanumeric' => [
        'title' => 'Alphanumeric',
        'description' => 'Only accept alpha numeric characters',
        'error' => 'Field should be alphanumeric',
        'parameters' => [
          'show' => [
            '#title' => 'Allow special characters',
            '#description' => 'If checked will allow special characters to be part of the validation',
            '#type' => 'checkbox',
            '#default_value' => true
          ],
        ],
      ],
      'numeric' => [
        'title' => 'Numeric',
        'description' => 'Only accept valid numbers (whole numbers and decimal)',
        'error' => 'Field should be numeric',
      ],
    ];
  }
}
