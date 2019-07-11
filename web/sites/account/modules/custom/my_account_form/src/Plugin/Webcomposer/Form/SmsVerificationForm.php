<?php

namespace Drupal\my_account_form\Plugin\Webcomposer\Form;

use Drupal\webcomposer_form_manager\WebcomposerFormBase;
use Drupal\webcomposer_form_manager\WebcomposerFormInterface;

/**
 * SMS verification form.
 *
 * @WebcomposerForm(
 *   id = "profile_sms_verification_form",
 *   name = "SMS Verification Form",
 * )
 */
class SmsVerificationForm extends WebcomposerFormBase implements WebcomposerFormInterface {

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
        '#title' => 'SMS Verification Form Alias',
        '#type' => 'textfield',
        '#description' => 'SMS Verification Form Alias',
      ],
    ];
  }

  /**
   * Set Fields.
   */
  public function getFields() {

    $fields = [];

    $fields['verification_code'] = [
      'name' => 'Verification Code',
      'type' => 'textfield',
      'settings' => [
        'label' => [
          '#title' => 'Verification Code Label',
          '#type' => 'textfield',
          '#description' => 'Verification code field label',
        ],
        'placeholder' => [
          '#title' => 'Verification Code placeholder label',
          '#type' => 'textfield',
          '#description' => 'Verification code field placeholder',
        ],
      ],
    ];

    $fields['resend_markup'] = [
      'name' => 'Resend Link',
      'type' => 'markup',
      'settings' => [
        'markup' => [
          '#title' => 'Resend Link',
          '#type' => 'text_format',
          '#default_value' => '',
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
