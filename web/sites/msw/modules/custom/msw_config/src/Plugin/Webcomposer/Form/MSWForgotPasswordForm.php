<?php

namespace Drupal\msw_config\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Forgot Password Form.
 *
 * @WebcomposerForm(
 *   id = "msw_forgot_password_form",
 *   name = "MSW Forgot Password Form",
 * )
 */
class MSWForgotPasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Change Password Form Alias',
        '#type' => 'textfield',
        '#description' => 'Forgot Password Form Alias',
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

    $fields['username'] = [
      'name' => 'Username',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Username label',
          '#type' => 'textfield',
          '#description' => 'label for Username field',
          '#default_value' => 'Username',
        ],
        'placeholder' => [
          '#title' => 'Username placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Username field placeholder',
          '#default_value' => 'Username',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
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
          '#default_value' => 'Email',
        ],
        'placeholder' => [
          '#title' => 'Email placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for Email field placeholder',
          '#default_value' => 'Email',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
        ],
        'enabled' => [
          '#title' => 'Enabled',
          '#default_value' => 1,
          '#type' => 'checkbox',
          '#description' => 'Field to check if the element is enabled.',
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
