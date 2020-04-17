<?php

namespace Drupal\reset_password\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * ResetPasswordForm
 *
 * @WebcomposerForm(
 *   id = "reset_password",
 *   name = "Reset Password Form",
 * )
 */
class ResetPasswordForm extends WebcomposerFormBase implements WebcomposerFormInterface {
  /**
   *
   */
  public function getSettings() {
    return [
      'footer' => [
        '#title' => 'Footer',
        '#type' => 'textarea',
        '#description' => 'Footer text for this form',
      ],
    ];
  }

  /**
   *
   */
  public function getFields() {
    return [
      'new_password' => [
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
            '#default_value' => 'New Password',
          ]
        ]
      ],

      'confirm_new_password' => [
        'name' => 'Confirm New Password',
        'type' => 'password',
        'settings' => [
          'label' => [
            '#title' => 'Confirm New Password Label',
            '#type' => 'textfield',
            '#description' => 'Confirm New password field label',
          ],
          'placeholder' => [
            '#title' => 'Confirm New password placeholder label',
            '#type' => 'textfield',
            '#description' => 'label for confirm new password field placeholder',
            '#default_value' => 'Confirm New Password',
          ]
        ]
      ],

      'submit' => [
        'name' => 'Submit',
        'type' => 'submit',
        'settings' => [
          'label' => [
            '#title' => 'Submit Label',
            '#type' => 'textfield',
            '#description' => 'Label for the submit button',
            '#default_value' => 'Submit',
          ],
        ],
      ],
    ];
  }
}
