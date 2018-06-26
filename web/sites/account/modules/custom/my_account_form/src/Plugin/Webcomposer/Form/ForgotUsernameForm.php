<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

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
class ForgotUsernameForm extends WebcomposerFormBase implements WebcomposerFormInterface
{

  /**
   * Get Settings.
   */
  public function getSettings()
  {
    return [
      'show' => [
        '#title' => 'Show this form',
        '#type' => 'checkbox',
        '#default_value' => true,
      ],
      'alias' => [
        '#title' => 'Change Password Form Alias',
        '#type' => 'textfield',
        '#description' => 'Forgot Username Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields()
  {

    $fields = [];

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

    return $fields;
  }

}
