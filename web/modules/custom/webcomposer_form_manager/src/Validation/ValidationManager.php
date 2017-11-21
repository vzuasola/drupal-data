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
    'alpha' => [
      'title' => 'Alpha',
      'description' => 'Only accept Alphabet characters',
      'error' => 'Field should be Alphabet characters only',
      'parameters' => [
        'spaces' => [
          '#title' => 'Accept Spaces',
          '#description' => 'Checks whether this validation should accept spaces or not',
          '#type' => 'checkbox',
          '#default_value' => true,
        ],
      ],
    ],
    'alphanumeric' => [
      'title' => 'Alphanumeric',
      'description' => 'Only accept alpha numeric characters',
      'error' => 'Field should be alphanumeric',
      'parameters' => [
        'spaces' => [
          '#title' => 'Accept Spaces',
          '#description' => 'Checks whether this validation should accept spaces or not',
          '#type' => 'checkbox',
          '#default_value' => true,
        ],
      ],
    ],
    'alpha_multi' => [ // accepts alpha and other multilingual characters
      'title' => 'Alpha Numeric (Multilingual)',
      'description' => 'Only accept multilingual alphabet letters as input',
      'error' => 'Value is not a valid multilingual character',
      'parameters' => [
        'space' => [
            '#title' => 'Accept spaces',
            '#description' => 'If checked will accept spaces as part of the formatting',
            '#type' => 'checkbox',
            '#default_value' => true,
        ],
        'numeric' => [
            '#title' => 'Accept numeric characters',
            '#description' => 'If checked will accept numeric as part of the formatting',
            '#type' => 'checkbox',
            '#default_value' => true,
        ],
        'allow' => [
            '#title' => 'Allow listed special characters',
            '#description' => 'If checked will allow listed special characters as part of the formatting',
            '#type' => 'checkbox',
            '#default_value' => false,
        ],
        'disallow' => [
            '#title' => 'Disallow listed special characters',
            '#description' => 'If checked will disallow listed special characters in the formatting and allow any other character regardless of options set',
            '#type' => 'checkbox',
            '#default_value' => false,
        ],
        'special' => [
            '#title' => 'Special Characters',
            '#type' => 'textarea',
            '#description' => 'The special characters to allow or disallow. If left blank and allow or disallow is checked will still disallow all special characters ',
            '#default_value' => '',
        ],
      ],
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
    'min_length' => [
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
    'max_length' => [
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
