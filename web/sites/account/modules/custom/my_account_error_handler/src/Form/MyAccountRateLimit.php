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

    $form['rate_limit_username'] = [
      '#type' => 'details',
      '#title' => 'Forgot Username',
      '#group' => 'forgot_username',
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

    $form['rate_limit_username']['rate_limit_username_message'] = [
      '#type' => 'textarea',
      '#title' => t('Message'),
      '#description' => $this->t('Message to display once player reached the limit operation.'),
      '#default_value' => $this->get('rate_limit_username_message'),
    ];

    return $form;
  }
}