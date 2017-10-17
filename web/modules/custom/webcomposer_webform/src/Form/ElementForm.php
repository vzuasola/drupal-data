<?php

namespace Drupal\webcomposer_webform\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Form for adding additional webform elements settings
 *
 * Used for validation
 */
class ElementForm {

  protected $elementProperties = [
    'visibility' => TRUE,
  ];

  protected $validationProperties = [
    'visibility' => TRUE,
    'required_error' => 'This field is required',
    'alphanumeric' => FALSE,
    'alphanumeric_error' => 'Input should be alphanumeric',
    'no_symbols' => FALSE,
    'no_symbols_error' => 'Input should not contain invalid symbols',
    'email' => FALSE,
    'email_error' => 'Input should be a valid email',
    'numeric' => FALSE,
    'numeric_error' => 'Input should be numeric',
    'numeric_symbols' => FALSE,
    'numeric_symbols_error' => 'Input should be numeric',
    'min_length' => FALSE,
    'min_length_value' => 5,
    'min_length_error' => 'Min length requirement not met',
    'max_length' => FALSE,
    'max_length_value' => 15,
    'max_length_error' => 'Max length exceeded',
  ];

  /**
   * 
   */
  public function getForm(&$form, FormStateInterface $form_state) {
    $this->elementSettings($form, $form_state);

    if (isset($form['properties']['validation'])) {
      $this->validationSettings($form, $form_state);
    }
  }

  /**
   * 
   */
  private function elementSettings(&$form, FormStateInterface $form_state) {
    // Retrieve the values from the custom properties element's default value.
    // @see \Drupal\webform\Plugin\WebformElementBase::buildConfigurationForm
    $custom_properties = $form['properties']['custom']['properties']['#default_value'];

    // Make sure to unset the custom properties which are going to be handled via
    // the below webform elements.
    $form['properties']['custom']['properties']['#default_value'] = array_diff_key(
      $custom_properties,
      $this->elementProperties
    );

    // Finally, append the default custom property values.
    $custom_properties += $this->elementProperties;

    $form['properties']['element']['visibility'] = [
      '#type' => 'checkbox',
      '#title' => t('Visibility'),
      '#description' => t('Show or hide this field. When unchecked will hide this field.'),
      '#parents' => ['properties', 'visibility'],
      '#default_value' => $custom_properties['visibility'],
    ];

    $callback = $form_state->getBuildInfo()['callback_object'];
    $type = $callback->getElement()['#type'];

    if ($type == 'fieldset') {
      $form['properties']['element']['legend'] = [
        '#type' => 'textfield',
        '#title' => t('Legend'),
        '#description' => t('The fieldset legend that will act as the title'),
        '#parents' => ['properties', 'legend'],
        '#default_value' => $custom_properties['legend'],
      ];

      $form['properties']['element']['class'] = [
        '#type' => 'textfield',
        '#title' => t('Class'),
        '#description' => t('Custom class for this fieldset'),
        '#parents' => ['properties', 'class'],
        '#default_value' => $custom_properties['class'],
      ];
    }
  }

  /**
   * 
   */
  private function validationSettings(&$form, FormStateInterface $form_state) {
    // Retrieve the values from the custom properties element's default value.
    // @see \Drupal\webform\Plugin\WebformElementBase::buildConfigurationForm
    $custom_properties = $form['properties']['custom']['properties']['#default_value'];

    // Make sure to unset the custom properties which are going to be handled via
    // the below webform elements.
    $form['properties']['custom']['properties']['#default_value'] = array_diff_key(
      $custom_properties,
      $this->validationProperties
    );

    // Finally, append the default custom property values.
    $custom_properties += $this->validationProperties;

    // Hide all fields except these
    $exclude = ['required', 'required_error'];

    foreach ($form['properties']['validation'] as $key => $value) {
      if (!in_array($key, $exclude) && is_array($value)) {
        $form['properties']['validation'][$key]['#access'] = FALSE;
      }
    }

    $form['properties']['validation']['#weight'] = -5;
    $form['properties']['validation']['required_error']['#description'] = t('The error message for the required validation');

    // Validation fields

    $form['properties']['validation']['alphanumeric'] = [
      '#type' => 'checkbox',
      '#title' => t('Alphanumeric'),
      '#description' => t('Make this field alphanumeric'),
      '#parents' => ['properties', 'alphanumeric'],
      '#default_value' => $custom_properties['alphanumeric'],
    ];

    $form['properties']['validation']['alphanumeric_error'] = [
      '#type' => 'textfield',
      '#title' => t('Alphanumeric error message'),
      '#description' => t('The error message for the alphanumeric validation'),
      '#parents' => ['properties', 'alphanumeric_error'],
      '#default_value' => $custom_properties['alphanumeric_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[alphanumeric]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['no_symbols'] = [
      '#type' => 'checkbox',
      '#title' => t('No Symbols'),
      '#description' => t('Make this field accept alphanumeric + spaces + foreign characters except special symbols'),
      '#parents' => ['properties', 'no_symbols'],
      '#default_value' => $custom_properties['no_symbols'],
    ];

    $form['properties']['validation']['no_symbols_error'] = [
      '#type' => 'textfield',
      '#title' => t('No Symbols error message'),
      '#description' => t('The error message for the no symbols validation'),
      '#parents' => ['properties', 'no_symbols_error'],
      '#default_value' => $custom_properties['no_symbols_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[no_symbols]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['email'] = [
      '#type' => 'checkbox',
      '#title' => t('Email'),
      '#description' => t('Make this field email'),
      '#parents' => ['properties', 'email'],
      '#default_value' => $custom_properties['email'],
    ];

    $form['properties']['validation']['email_error'] = [
      '#type' => 'textfield',
      '#title' => t('Email error message'),
      '#description' => t('The error message for the email validation'),
      '#parents' => ['properties', 'email_error'],
      '#default_value' => $custom_properties['email_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[email]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['numeric'] = [
      '#type' => 'checkbox',
      '#title' => t('Numeric'),
      '#description' => t('Make this field numeric'),
      '#parents' => ['properties', 'numeric'],
      '#default_value' => $custom_properties['numeric'],
    ];

    $form['properties']['validation']['numeric_error'] = [
      '#type' => 'textfield',
      '#title' => t('Numeric error message'),
      '#description' => t('The error message for the numeric validation'),
      '#parents' => ['properties', 'numeric_error'],
      '#default_value' => $custom_properties['numeric_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[numeric]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['numeric_symbols'] = [
      '#type' => 'checkbox',
      '#title' => t('Numeric with Symbols'),
      '#description' => t('Make this field numeric with symbols'),
      '#parents' => ['properties', 'numeric_symbols'],
      '#default_value' => $custom_properties['numeric_symbols'],
    ];

    $form['properties']['validation']['numeric_symbols_error'] = [
      '#type' => 'textfield',
      '#title' => t('Numeric with Symbols error message'),
      '#description' => t('The error message for the numeric symbols validation'),
      '#parents' => ['properties', 'numeric_symbols_error'],
      '#default_value' => $custom_properties['numeric_symbols_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[numeric_symbols]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['min_length'] = [
      '#type' => 'checkbox',
      '#title' => t('Minimum Length'),
      '#description' => t('Specify a minimum value length'),
      '#parents' => ['properties', 'min_length'],
      '#default_value' => $custom_properties['min_length'],
    ];

    $form['properties']['validation']['min_length_value'] = [
      '#type' => 'number',
      '#title' => t('Minimum length value'),
      '#description' => t('The validation value'),
      '#parents' => ['properties', 'min_length_value'],
      '#default_value' => $custom_properties['min_length_value'],
      '#states' => [
        'visible' => [
          ':input[name="properties[min_length]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['min_length_error'] = [
      '#type' => 'textfield',
      '#title' => t('Minimum length error message'),
      '#description' => t('The error message for the numeric symbols validation'),
      '#parents' => ['properties', 'min_length_error'],
      '#default_value' => $custom_properties['min_length_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[min_length]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['max_length'] = [
      '#type' => 'checkbox',
      '#title' => t('Maximum Length'),
      '#description' => t('Specify a maximum value length'),
      '#parents' => ['properties', 'max_length'],
      '#default_value' => $custom_properties['max_length'],
    ];

    $form['properties']['validation']['max_length_value'] = [
      '#type' => 'number',
      '#title' => t('Maximum length value'),
      '#description' => t('The validation value'),
      '#parents' => ['properties', 'max_length_value'],
      '#default_value' => $custom_properties['max_length_value'],
      '#states' => [
        'visible' => [
          ':input[name="properties[max_length]"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['properties']['validation']['max_length_error'] = [
      '#type' => 'textfield',
      '#title' => t('Maximum length error message'),
      '#description' => t('The error message for the numeric symbols validation'),
      '#parents' => ['properties', 'max_length_error'],
      '#default_value' => $custom_properties['max_length_error'],
      '#states' => [
        'visible' => [
          ':input[name="properties[max_length]"]' => ['checked' => TRUE],
        ],
      ],
    ];
  }
}
