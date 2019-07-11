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
   * The Webcomposer Form Validation manager
   *
   * @var object
   */
  private $validationManager;

  /**
   * Public constructor
   */
  public function __construct($pluginManager, $validationManager) {
    $this->pluginManager = $pluginManager;
    $this->validationManager = $validationManager;
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
   * @return array
   */
  public function getValidations() {
    return $this->validationManager->getDefaults();
  }
}
