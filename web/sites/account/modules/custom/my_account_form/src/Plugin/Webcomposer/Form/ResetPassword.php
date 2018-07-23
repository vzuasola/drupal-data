<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * Reset Password Form.
 *
 * @WebcomposerForm(
 *   id = "account_reset_password_form",
 *   name = "Reset Password Form",
 * )
 */
class ResetPassword extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Reset Password Form Alias',
        '#type' => 'textfield',
        '#description' => 'Reset Password Form Alias',
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

    $fields['new_password'] = [
      'name' => 'New Password',
      'type' => 'password',
      'settings' => [
        'label' => [
          '#title' => 'New Password Label',
          '#type' => 'textfield',
          '#description' => 'New password field label',
        ],
        'placeholder' => [
          '#title' => 'New password placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for new password field placeholder',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
        ],
      ],
    ];

    $fields['password_meter'] = [
      'name' => 'Password Meter',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Password meter markup',
          '#type' => 'textarea',
          '#description' => 'HTML markup for password meter.',
          '#default_value' => '<div class="password_meter_wrapper password-meter-hidden grid mb-0"></div>',
        ],
      ],
    ];

    $fields['verify_password'] = [
      'name' => 'Verify Password',
      'type' => 'password',
      'settings' => [
        'label' => [
          '#title' => 'Verify Password Label',
          '#type' => 'textfield',
          '#description' => 'Verify password field label',
        ],
        'placeholder' => [
          '#title' => 'Verify password placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for verify password field placeholder',
        ],
        'annotation' => [
          '#title' => 'Annotation text',
          '#type' => 'textarea',
          '#description' => 'field annotation that will be displayed on focus',
        ],
      ],
    ];

    $fields['submit'] = [
      'name' => 'Save',
      'type' => 'submit',
      'settings' => [
        'label' => [
          '#title' => 'Save Label',
          '#type' => 'textfield',
          '#description' => 'Label for the Save button',
          '#default_value' => 'Save Changes',
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
