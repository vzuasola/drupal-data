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

    // Cant-Login - Username
    $form['rate_limit_username'] = [
      '#type' => 'details',
      '#title' => 'Forgot Username',
      '#group' => 'rate_limit',
      '#open' => TRUE,
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

    // SMS Flooding
    $form['rate_limit_sms'] = [
      '#type' => 'details',
      '#title' => 'SMS Flood',
      '#group' => 'rate_limit',
      '#open' => TRUE,
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

    return $form;
  }
}