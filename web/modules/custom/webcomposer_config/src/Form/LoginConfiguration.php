<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

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

  /**`
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.login_configuration');

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
      );

    $form['login_form_details'] = array(
      '#type' => 'details',
      '#title' => t('Login Form Settings'),
      '#group' => 'advanced',
      );

    $form['login_form_details'] ['username_placeholder'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Username Placeholder'),
      '#default_value' => $config->get('username_placeholder'),
      );

    $form['login_form_details'] ['password_placeholder'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password Placeholder'),
      '#default_value' => $config->get('password_placeholder'),
      );

    $form['login_form_details'] ['login_bottom_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Login Botton Label'),
      '#default_value' => $config->get('login_bottom_label'),
      );

    $form['login_form_details'] ['lightbox_blurb'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Login lightbox blurb'),
      '#default_value' => $config->get('lightbox_blurb'),
    );


    $form['login_form_error_messages_details'] = array(
      '#type' => 'details',
      '#title' => t('Error Messages'),
      '#group' => 'advanced',
      );

    $form['login_form_error_messages_details']['error_message_blank_username'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username'),
      '#default_value' => $config->get('error_message_blank_username'),
      );

    $form['login_form_error_messages_details']['error_message_blank_password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Blank Password'),
      '#default_value' => $config->get('error_message_blank_password'),
      );

    $form['login_form_error_messages_details']['error_message_blank_passname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Blank Username and Password'),
      '#default_value' => $config->get('error_message_blank_passname'),
      );

    $form['login_form_error_messages_details']['error_message_invalid_passname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Invalid Username and Password'),
      '#default_value' => $config->get('error_message_invalid_passname'),
      );

    $form['login_form_error_messages_details']['error_message_account_suspended'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Player account is Suspended/Closed'),
      '#default_value' => $config->get('error_message_account_suspended'),
      );

    $form['login_form_error_messages_details']['error_message_account_locked'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('  Player account is locked after (X) consecutive login attempt'),
      '#description' => $this->t('Note: number of attempts (X) and number of minutes (Y) configuration is located at the Middleware.'),
      '#default_value' => $config->get('error_message_account_locked'),
      );

    $form['login_form_error_messages_details']['error_message_service_not_available'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Error thrown by services'),
      '#default_value' => $config->get('error_message_service_not_available'),
      );

    $form['session_timeout_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Settings'),
      '#group' => 'advanced',
    ];

    $form['session_timeout_details']['session_maxtime'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Maximum Session Time'),
      '#default_value' => $config->get('session_maxtime'),
      '#description' => $this->t('The maximum time after which the Player gets automatically logged Out.'),
      '#required' => TRUE,
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

    $notification_content = $config->get('notification_content');
    $form['notification_box_details']['notification_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Autologout Notification Box Content'),
      '#description' => $this->t('The Content of the Auto logout Notification LightBox'),
      '#default_value' => $notification_content['value'],
      '#format' => $notification_content['format'],
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $loginValuesKeys = array(
      'username_placeholder',
      'password_placeholder',
      'login_bottom_label',
      'username_validation_min',
      'username_validation_max',
      'password_validation_min',
      'password_validation_max',
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
      'notification_content',
      'lightbox_blurb'
      );

    foreach ($loginValuesKeys as $keys){
      $this->config('webcomposer_config.login_configuration')->set($keys, $form_state->getValue($keys))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
