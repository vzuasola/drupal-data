<?php

namespace Drupal\webcomposer_form_manager\Validation;

/**
 * Handles the validation sets
 */
class ValidationManager {
  /**
   * Default validation set
   */
  const DEFAULTS = [
    'required' => [
      'title' => 'Required',
      'description' => 'Make this field required. Does not accept empty string inputs such as nulls and whitespace only.',
      'error' => 'Field should be required',
    ],
    'alphanumeric' => [
      'title' => 'Alphanumeric',
      'description' => 'Only accept alpha numeric characters',
      'error' => 'Field should be alphanumeric',
    ],
    'numeric' => [
      'title' => 'Numeric',
      'description' => 'Only accept valid numbers (whole numbers and decimal)',
      'error' => 'Field should be numeric',
    ],
    'no_symbols' => [
      'title' => 'No Symbols',
      'description' => 'Make this field accept alphanumeric + spaces + foreign characters except special symbols',
      'error' => 'Field contains invalid special characters',
    ],
    'numeric_symbols' => [
      'title' => 'Numeric with Symbols',
      'description' => 'Make this field accept numeric character and these symbols + - ( )',
      'error' => 'Field contains invalid special characters',
    ],
    'email' => [
      'title' => 'Email',
      'description' => 'Make this field accept only valid email characters',
      'error' => 'Field does not contain a valid email address',
    ],
    'min' => [
      'title' => 'Min Length',
      'description' => 'Accept only a minimum character',
      'error' => 'Minimum requirement not met',
      'parameters' => [
        'length' => [
          '#title' => 'The range value',
          '#description' => 'The range of this validation',
          '#type' => 'number',
          '#default_value' => 2
        ],
      ],
    ],
    'max' => [
      'title' => 'Max Length',
      'description' => 'Accept only a maximum character',
      'error' => 'Maximum requirement not met',
      'parameters' => [
        'length' => [
          '#title' => 'The range value',
          '#description' => 'The range of this validation',
          '#type' => 'number',
          '#default_value' => 10
        ],
      ],
    ],
  ];

  /**
   * The Webcomposer Form module handler
   *
   * @var object
   */
  private $moduleHandler;

  /**
   * Public constructor
   */
  public function __construct($moduleHandler) {
    $this->moduleHandler = $moduleHandler;
  }

  /**
   * Gets the default validation set
   */
  public function getDefaults() {
    $validations = self::DEFAULTS;

    $this->moduleHandler->alter('webcomposer_form_validation', $validations);

    return $validations;
  }
}
