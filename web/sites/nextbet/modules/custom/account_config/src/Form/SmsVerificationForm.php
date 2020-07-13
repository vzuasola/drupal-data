<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

 /* @WebcomposerConfigPlugin(
  *   id = "profile_sms_verification_form",
  *  route = {
  *     "title" = "SMS Verification Configuration",
  *     "path" = "/admin/config/my-account/sms-verification",
  *   },
  *   menu = {
  *     "title" = "SMS Verification",
  *     "description" = "SMS Verification Configuration",
  *     "parent" = "account_config.list",
  *   },
  * )
  */
class SmsVerificationForm extends FormBase {

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
