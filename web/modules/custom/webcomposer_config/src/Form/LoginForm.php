<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Login configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_session",
 *   route = {
 *     "title" = "Login Configuration",
 *     "path" = "/admin/config/webcomposer/config/login",
 *   },
 *   menu = {
 *     "title" = "Login Configuration",
 *     "description" = "Provides configuration for session related features",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class LoginForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.login_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Login Configuration'),
    ];

    $form['login_form_details'] = [
      '#type' => 'details',
      '#title' => t('Login Form Settings'),
      '#group' => 'advanced',
    ];

    $form['login_form_details']['username_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username Placeholder'),
      '#default_value' => $this->get('username_placeholder'),
      '#translatable' => TRUE,
    ];

    $form['login_form_details']['password_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Placeholder'),
      '#default_value' => $this->get('password_placeholder'),
      '#translatable' => TRUE,
    ];

    $form['login_form_details']['login_bottom_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Button Label'),
      '#default_value' => $this->get('login_bottom_label'),
      '#translatable' => TRUE,
    ];

    $form['login_form_details']['rememberme_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Remember Me Label'),
      '#default_value' => $this->get('rememberme_label'),
      '#translatable' => TRUE,
    ];

    $form['login_form_details']['lightbox_blurb'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login lightbox blurb'),
      '#default_value' => $this->get('lightbox_blurb'),
      '#translatable' => TRUE,
    ];

    $form['login_form_details']['login_page_blurb'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login Page Blurb'),
      '#default_value' => $this->get('login_page_blurb'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details'] = [
      '#type' => 'details',
      '#title' => t('Error Messages'),
      '#group' => 'advanced',
    ];

    $form['login_form_error_messages_details']['error_message_blank_username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username'),
      '#default_value' => $this->get('error_message_blank_username'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_blank_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Password'),
      '#default_value' => $this->get('error_message_blank_password'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_blank_passname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username and Password'),
      '#default_value' => $this->get('error_message_blank_passname'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_invalid_passname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Invalid Username and Password'),
      '#default_value' => $this->get('error_message_invalid_passname'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_account_suspended'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Player account is Suspended/Closed'),
      '#default_value' => $this->get('error_message_account_suspended'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_account_locked'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Player account is locked after (X) consecutive login attempt'),
      '#description' => $this->t('Note: number of attempts (X) and number of minutes (Y) configuration is located at the middleware.'),
      '#default_value' => $this->get('error_message_account_locked'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_restricted_country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Error for restricted country'),
      '#default_value' => $this->get('error_message_restricted_country'),
      '#translatable' => TRUE,
    ];

    $form['login_form_error_messages_details']['error_message_service_not_available'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Error thrown by services'),
      '#default_value' => $this->get('error_message_service_not_available'),
      '#translatable' => TRUE,
    ];

    $form['session_timeout_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Settings'),
      '#group' => 'advanced',
    ];

    $form['session_timeout_details']['session_maxtime'] = [
      '#type' => 'number',
      '#title' => $this->t('Maximum Session Time'),
      '#default_value' => $this->get('session_maxtime'),
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
      '#default_value' => $this->get('autologout_box_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('autologout_box_content');

    $form['lightbox_details']['autologout_box_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Auto Logout LightBox Content'),
      '#description' => $this->t('The Content of the Auto Logout LightBox.'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['lightbox_details']['affirmative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Affirmative Response text'),
      '#description' => $this->t('The Affirmative Button text in Auto Logout LightBox.'),
      '#default_value' => $this->get('affirmative_button_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['lightbox_details']['negative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Negative Response text'),
      '#description' => $this->t('The Negative response Button text in Auto Logout LightBox.'),
      '#default_value' => $this->get('negative_button_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#default_value' => $this->get('notification_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['notification_box_details']['notification_window_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Notification Window Title'),
      '#description' => $this->t('The Blinking Window Title of the Notification LightBox'),
      '#default_value' => $this->get('notification_window_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $notification_content = $this->get('notification_content');

    $form['notification_box_details']['notification_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Autologout Notification Box Content'),
      '#description' => $this->t('The Content of the Auto logout Notification LightBox'),
      '#default_value' => $notification_content['value'],
      '#format' => $notification_content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#default_value' => $this->get('mobile_login_url'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['mobile_login']['mobile_login_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Login Button Label'),
      '#description' => $this->t('Label to be used in mobile.'),
      '#default_value' => $this->get('mobile_login_button_label'),
      '#translatable' => TRUE,
    ];

    $form['mobile_login']['mobile_cant_login_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Cant Login URL'),
      '#default_value' => $this->get('mobile_cant_login_url'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
