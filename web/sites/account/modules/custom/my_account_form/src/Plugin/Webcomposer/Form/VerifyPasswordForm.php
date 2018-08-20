<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ChangePasswordForm.
 *
 * @WebcomposerForm(
 *   id = "profile_verify_password_form",
 *   name = "Verify Password Form",
 * )
 */
class VerifyPasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'Verify Password Form Alias',
        '#type' => 'textfield',
        '#description' => 'Verify Password Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {

    $fields = [];

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

    return $fields;
  }

}
