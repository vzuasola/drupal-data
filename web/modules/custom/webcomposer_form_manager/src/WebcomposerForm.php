<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * 
 */
class WebcomposerForm {
  /**
   *
   */
  private $module_handler;
  /**
   *
   */
  public function __construct($module_handler){
    $this->module_handler = $module_handler;
  }

  /**
   *
   */
  public function getFormList() {
    $form_manager =\Drupal::service('plugin.manager.form_manager');
    $form_manager_definitions = $form_manager->getDefinitions();

    $result = [];

    foreach ($form_manager_definitions as $definition) {
      $id = $definition['id'];
      $result[$id]['name'] = $definition['label'];
    }

    return $result; 
  }

  /**
   * 
   */
  public function getFormById($id) {
    $formOneSettings = [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => true
      ],
      'alias' => [
        '#title' => 'Form alias',
        '#type' => 'textfield',
        '#description' => 'The alias for this form',
      ],
    ];

    $formOne = new WebcomposerFormEntity('form_one', 'Test form', $formOneSettings);

    $formOne->setField(
      new WebcomposerFormFieldEntity('firstname', 'First name', 'textfield', ['default_value' => 'Leo'])
    );

    $formOne->setField(
      new WebcomposerFormFieldEntity('lastname', 'Last name', 'textfield', ['default_value' => 'Drew'], [
        'alias' => [
          '#title' => 'Last name alias',
          '#type' => 'textfield',
          '#description' => 'The alias for this last name',
        ],
      ])
    );

    $formOne->setField(
      new WebcomposerFormFieldEntity('password', 'Password', 'textfield', ['default_value' => 'Leo'])
    );

    $forms = [
      'form_one' => $formOne,
    ];

    return $forms[$id] ?? NULL;
  }

  /**
   * @todo Create an alter hook so modules can alter the validation sets
   * @todo Sync the validation behavior and description with Webform Validations
   */
  public function getValidations() {
   $validation = [
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

    $this->module_handler->alter('webcomposer_form_validation', $validation);
    return $validation;
  }
}
