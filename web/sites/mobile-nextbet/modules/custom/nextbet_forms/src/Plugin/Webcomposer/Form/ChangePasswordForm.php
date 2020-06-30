<?php

namespace Drupal\nextbet_forms\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ChangePasswordForm.
 *
 * @WebcomposerForm(
 *   id = "account_change_password_form",
 *   name = "Change Password Form",
 * )
 */
class ChangePasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#description' => 'Change Password Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {

    $fields = [];

    $fields['current_password'] = [
      'name' => 'Current Password',
      'type' => 'password',
      'settings' => [
        'label' => [
          '#title' => 'Current Password Label',
          '#type' => 'textfield',
          '#description' => 'Current password field label',
        ],
        'placeholder' => [
          '#title' => 'Current password placeholder label',
          '#type' => 'textfield',
          '#description' => 'label for current password field placeholder',
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

    $fields['password_meter'] = [
      'name' => 'Password Meter',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Password meter markup',
          '#type' => 'textarea',
          '#description' => 'HTML markup for password meter.',
          '#default_value' => '',
        ],
      ],
    ];

    return $fields;
  }

}
