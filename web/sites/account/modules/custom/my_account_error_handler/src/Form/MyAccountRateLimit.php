<?php

namespace Drupal\my_account_error_handler\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account - Rate Limit.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_error_handler.rate_limit",
 *   route = {
 *     "title" = "Rate Limit Configuration",
 *     "path" = "/admin/config/my_account/ratelimit",
 *   },
 *   menu = {
 *     "title" = "Rate Limit",
 *     "description" = "My Account - Rate Limit configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountRateLimit extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_error_handler.rate_limit'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['rate_limit'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->sectionForgotUsername($form);
    $this->sectionSMSFlooding($form);
    $this->sectionBonusCode($form);
    return $form;
  }

  private function sectionForgotUsername(array &$form)
  {
    // Cant-Login - Username
    $form['rate_limit_username'] = [
      '#type' => 'details',
      '#title' => 'Forgot Username',
      '#group' => 'rate_limit',
      '#open' => TRUE,
    ];
    $form['rate_limit_username']['rate_limit_username_type'] = [
      '#type' => 'select',
      '#options' => [
        'ip_mode' => $this->t('IP'),
      ],
      '#title' => t('Rate Limit Type'),
      '#description' => $this->t('Rate limit by IP/User ID/IP and User ID'),
      '#default_value' => $this->get('rate_limit_username_type') ?? 'ip_mode',
    ];
    $form['rate_limit_username']['rate_limit_username_interval'] = [
      '#type' => 'textfield',
      '#title' => t('Interval'),
      '#description' => $this->t('Rate limit interval in seconds'),
      '#default_value' => $this->get('rate_limit_username_interval') ?? 60,
    ];
    $form['rate_limit_username']['rate_limit_username_operation'] = [
      '#type' => 'textfield',
      '#title' => t('Rate Limit Operation'),
      '#description' => $this->t('Allowed Request'),
      '#default_value' => $this->get('rate_limit_username_operation') ?? 1,
    ];
  }

  private function sectionSMSFlooding(array &$form)
  {
    // SMS Flooding
    $form['rate_limit_sms'] = [
      '#type' => 'details',
      '#title' => 'SMS Flood',
      '#group' => 'rate_limit',
      '#open' => TRUE,
    ];
    $form['rate_limit_sms']['rate_limit_sms_type'] = [
      '#type' => 'select',
      '#options' => [
        'user_mode' => $this->t('Username'),
        'ip_mode' => $this->t('IP'),
        'phone_mode' => $this->t('Phone'),
        'user_ip_mode' => $this->t('Username & IP'),
        'user_ip_phone_mode' => $this->t('Username & IP & Phone'),
      ],
      '#title' => t('Rate Limit Type'),
      '#description' => $this->t('Rate limit by IP/Username/IP-Username'),
      '#default_value' => $this->get('rate_limit_sms_type') ?? 'user_mode',
    ];
    $form['rate_limit_sms']['rate_limit_sms_interval'] = [
      '#type' => 'textfield',
      '#title' => t('Interval'),
      '#description' => $this->t('Rate limit interval in seconds'),
      '#default_value' => $this->get('rate_limit_sms_interval') ?? 60,
    ];
    $form['rate_limit_sms']['rate_limit_sms_operation'] = [
      '#type' => 'textfield',
      '#title' => t('Rate Limit Operation'),
      '#description' => $this->t('Allowed Request'),
      '#default_value' => $this->get('rate_limit_sms_operation') ?? 1,
    ];
    $form['rate_limit_sms']['rate_limit_sms_error_message'] = [
      '#type' => 'textfield',
      '#title' => t('Rate Limit Error Message'),
      '#description' => $this->t('The message to display when the rate limit is exceeded'),
      '#default_value' => $this->get('rate_limit_sms_error_message') ?? 'You have exceeded the maximum number of SMS requests. Please try again later.',
      '#translatable' => TRUE,
    ];
    $form['rate_limit_sms']['rate_limit_sms_block_countries_list'] = [
        '#type' => 'textfield',
        '#title' => t('Block SMS Verification p/Country'),
        '#description' => $this->t('Blocks SMS number verification per country. <br>Example: "us;fr;..." or/mixed "us:+152;fr:+698;sp:+654,+652;..."'),
        '#default_value' => $this->get('rate_limit_sms_block_countries_list') ?? '',
    ];
    $form['rate_limit_sms']['rate_limit_sms_block_countries_error_message'] = [
        '#type' => 'textfield',
        '#title' => t('Block SMS Verification p/Country Error Message'),
        '#description' => $this->t('The message to display when the user country is in the blocked p/Country list'),
        '#default_value' => $this->get('rate_limit_sms_block_countries_error_message') ?? 'Mobile number verification is currently not accessible for your territory.',
        '#translatable' => TRUE,
    ];
  }

  private function sectionBonusCode(array &$form)
  {
    // Bonus Code
    $form['rate_limit_bonus_code'] = [
      '#type' => 'details',
      '#title' => 'Bonus Code',
      '#group' => 'rate_limit',
      '#open' => TRUE,
    ];

    $form['rate_limit_bonus_code']['rate_limit_bonus_code_enable'] = [
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#description' => $this->t('Check this if you want to enable rate limit'),
      '#default_value' => $this->get('rate_limit_bonus_code_enable'),
    ];

    $form['rate_limit_bonus_code']['rate_limit_bonus_code_type'] = [
      '#type' => 'select',
      '#options' => [
        'user_mode' => $this->t('Username'),
        'ip_mode' => $this->t('IP'),
        'user_ip_mode' => $this->t('Username & IP'),
      ],
      '#title' => t('Rate Limit Type'),
      '#description' => $this->t('Rate limit by IP/Username/IP-Username'),
      '#default_value' => $this->get('rate_limit_bonus_code_type') ?? 'user_mode',
    ];

    $form['rate_limit_bonus_code']['rate_limit_bonus_code_interval'] = [
      '#type' => 'textfield',
      '#title' => t('Interval'),
      '#description' => $this->t('Rate limit interval in seconds'),
      '#default_value' => $this->get('rate_limit_bonus_code_interval') ?? 60,
    ];

    $form['rate_limit_bonus_code']['rate_limit_bonus_code_operation'] = [
      '#type' => 'textfield',
      '#title' => t('Rate Limit Operation'),
      '#description' => $this->t('Allowed Request'),
      '#default_value' => $this->get('rate_limit_bonus_code_operation') ?? 1,
    ];

    $form['rate_limit_bonus_code']['rate_limit_bonus_code_error_message'] = [
      '#type' => 'textfield',
      '#title' => t('Error Message'),
      '#description' => $this->t('Rate limit Error Message'),
      '#default_value' => $this->get('rate_limit_bonus_code_error_message'),
      '#translatable' => TRUE,
    ];
  }
}
