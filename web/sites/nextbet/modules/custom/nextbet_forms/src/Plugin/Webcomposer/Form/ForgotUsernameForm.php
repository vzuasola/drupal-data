<?php

namespace Drupal\nextbet_forms\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Forgot Username Form.
 *
 * @WebcomposerForm(
 *   id = "forgot_username_form",
 *   name = "Forgot Username Form",
 * )
 */
class ForgotUsernameForm extends WebcomposerFormBase implements WebcomposerFormInterface {

  /**
   * Get Settings.
   */
  public function getSettings() {
    return [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => TRUE,
      ],
      'alias' => [
        '#title' => 'Forgot Username Form Alias',
        '#type' => 'textfield',
        '#description' => 'Forgot Username Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {
    $fields = [];

    $fields['header_markup'] = [
      'name' => 'Header Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Header Blurb',
          '#type' => 'text_format',
          '#default_value' => '',
        ],
      ],
    ];

    $fields['email'] = [
      'name' => 'Email',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Email Label',
          '#type' => 'textfield',
          '#description' => 'The Label for Email field',
        ],
        'placeholder' => [
          '#title' => 'Email placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Email field placeholder',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
        ],
      ],
    ];

    $fields['submit'] = [
      'name' => 'Submit',
      'type' => 'submit',
      'settings' => [
        'label' => [
          '#title' => 'Submit Label',
          '#type' => 'textfield',
          '#description' => 'Label for the Submit button',
          '#default_value' => 'Submit',
        ],
      ],
    ];

    $fields['footer_markup'] = [
      'name' => 'Footer Markup',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Footer Blurb',
          '#type' => 'text_format',
          '#default_value' => '',
        ],
      ],
    ];

    return $fields;
  }

}
