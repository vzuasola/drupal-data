<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Login configuration.
 */
class LoginConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.login_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'login_config_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.login_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['login_form_details'] = [
      '#type' => 'details',
      '#title' => t('Login Form Settings'),
      '#group' => 'advanced',
    ];

    $form['login_form_details']['username_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username Placeholder'),
      '#default_value' => $config->get('username_placeholder'),
    ];

    $form['login_form_details']['password_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Placeholder'),
      '#default_value' => $config->get('password_placeholder'),
    ];

    $form['login_form_details']['login_bottom_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Button Label'),
      '#default_value' => $config->get('login_bottom_label'),
    ];

    $form['login_form_details']['lightbox_blurb'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login lightbox blurb'),
      '#default_value' => $config->get('lightbox_blurb'),
    ];

    $form['login_form_details']['login_page_blurb'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login Page Blurb'),
      '#default_value' => $config->get('login_page_blurb'),
    ];

    $form['login_form_error_messages_details'] = [
      '#type' => 'details',
      '#title' => t('Error Messages'),
      '#group' => 'advanced',
    ];

    $form['login_form_error_messages_details']['error_message_blank_username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username'),
      '#default_value' => $config->get('error_message_blank_username'),
    ];

    $form['login_form_error_messages_details']['error_message_blank_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Password'),
      '#default_value' => $config->get('error_message_blank_password'),
    ];

    $form['login_form_error_messages_details']['error_message_blank_passname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username and Password'),
      '#default_value' => $config->get('error_message_blank_passname'),
    ];

    $form['login_form_error_messages_details']['error_message_invalid_passname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Invalid Username and Password'),
      '#default_value' => $config->get('error_message_invalid_passname'),
    ];

    $form['login_form_error_messages_details']['error_message_account_suspended'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Player account is Suspended/Closed'),
      '#default_value' => $config->get('error_message_account_suspended'),
    ];

    $form['login_form_error_messages_details']['error_message_account_locked'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Player account is locked after (X) consecutive login attempt'),
      '#description' => $this->t('Note: number of attempts (X) and number of minutes (Y) configuration is located at the middleware.'),
      '#default_value' => $config->get('error_message_account_locked'),
    ];

    $form['login_form_error_messages_details']['error_message_service_not_available'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Error thrown by services'),
      '#default_value' => $config->get('error_message_service_not_available'),
    ];

    $form['session_timeout_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Settings'),
      '#group' => 'advanced',
    ];

    $form['session_timeout_details']['session_maxtime'] = [
      '#type' => 'number',
      '#title' => $this->t('Maximum Session Time'),
      '#default_value' => $config->get('session_maxtime'),
      '#description' => $this->t('The maximum time in <strong>minutes</strong> after which the player gets automatically logged out.'),
      '#required' => TRUE,
      '#min' => 0.1,
      '#step' => 0.1,
    ];

    $form['lightbox_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Box Settings'),
      '#group' => 'advanced',
    ];

    $form['lightbox_details']['autologout_box_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Auto Logout LightBox Title'),
      '#description' => $this->t('The Title of the Auto Logout LightBox.'),
      '#default_value' => $config->get('autologout_box_title'),
      '#required' => TRUE,
    ];

    $content = $config->get('autologout_box_content');
    $form['lightbox_details']['autologout_box_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Auto Logout LightBox Content'),
      '#description' => $this->t('The Content of the Auto Logout LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
    ];

    $form['lightbox_details']['affirmative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Affirmative Response text'),
      '#description' => $this->t('The Affirmative Button text in Auto Logout LightBox.'),
      '#default_value' => $config->get('affirmative_button_text'),
      '#required' => TRUE,
    ];

    $form['lightbox_details']['negative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Negative Response text'),
      '#description' => $this->t('The Negative response Button text in Auto Logout LightBox.'),
      '#default_value' => $config->get('negative_button_text'),
      '#required' => TRUE,
    ];

    $form['notification_box_details'] = [
      '#type' => 'details',
      '#title' => t('Notification Box Settings'),
      '#group' => 'advanced',
    ];

    $form['notification_box_details']['notification_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Autologout Notification Box Title'),
      '#description' => $this->t('The Title of the Auto logout Notification LightBox'),
      '#default_value' => $config->get('notification_title'),
      '#required' => TRUE,
    ];

    $form['notification_box_details']['notification_window_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Notification Window Title'),
      '#description' => $this->t('The Blinking Window Title of the Notification LightBox'),
      '#default_value' => $config->get('notification_window_title'),
      '#required' => TRUE,
    ];

    $notification_content = $config->get('notification_content');
    $form['notification_box_details']['notification_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Autologout Notification Box Content'),
      '#description' => $this->t('The Content of the Auto logout Notification LightBox'),
      '#default_value' => $notification_content['value'],
      '#format' => $notification_content['format'],
      '#required' => TRUE,
    ];

    $form['mobile_login'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Login'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['mobile_login']['mobile_login_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Login URL'),
      '#description' => $this->t('URL to be used in login button for mobile'),
      '#default_value' => $config->get('mobile_login_url'),
      '#required' => TRUE,
    ];
    $form['mobile_login']['mobile_login_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Login Button Label'),
      '#description' => $this->t('Label to be used in mobile.'),
      '#default_value' => $config->get('mobile_login_button_label'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $loginValuesKeys = [
      'username_placeholder',
      'password_placeholder',
      'login_bottom_label',
      'error_message_blank_username',
      'error_message_blank_password',
      'error_message_blank_passname',
      'error_message_invalid_passname',
      'error_message_service_not_available',
      'error_message_account_suspended',
      'error_message_account_locked',
      'session_maxtime',
      'autologout_box_title',
      'autologout_box_content',
      'affirmative_button_text',
      'negative_button_text',
      'notification_title',
      'notification_window_title',
      'notification_content',
      'lightbox_blurb',
      'login_page_blurb',
      'mobile_login_url',
      'mobile_login_button_label',
    ];

    foreach ($loginValuesKeys as $keys) {
      $this->config('webcomposer_config.login_configuration')->set($keys, $form_state->getValue($keys))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
