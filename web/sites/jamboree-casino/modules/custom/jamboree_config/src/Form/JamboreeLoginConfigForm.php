<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_login_config",
 *   route = {
 *     "title" = "Login Form Configuration",
 *     "path" = "/admin/config/jamboree/login_configuration",
 *   },
 *   menu = {
 *     "title" = "Login Configuration",
 *     "description" = "Provides Login Form configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 31
 *   },
 * )
 */
class JamboreeLoginConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.login_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionLoginConfig($form);
    $this->sectionLoginSessionConfig($form);
    $this->sectionChangePassConfig($form);
    $this->sectionChangePassErrorMessages($form);

    return $form;
  }

  private function sectionLoginConfig(array &$form) {

    $form['login_form'] = [
      '#type' => 'details',
      '#title' => $this->t('Jamboree Login Form Configuration'),
    ];

    $default_login_button_main = $this->get('login_button_label_main');
    $form['login_form']['login_button_label_main'] = [
      '#type' => 'textfield',
      '#title' => t('Login Button Label Main'),
      '#default_value' => $default_login_button_main,
      '#description' => $this->t('Login Button big label that triggers login lightbox.'),
      '#translatable' => TRUE,
    ];

    $default_login_button_sub = $this->get('login_button_label_sub');
    $form['login_form']['login_button_label_sub'] = [
      '#type' => 'textfield',
      '#title' => t('Login Button Label Sub'),
      '#default_value' => $default_login_button_sub,
      '#description' => $this->t('Login Button small label that triggers login lightbox.'),
      '#translatable' => TRUE,
    ];

    $default_login_title = $this->get('login_lightbox_title');
    $form['login_form']['login_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => t('Login Lightbox Title'),
      '#default_value' => $default_login_title,
      '#description' => $this->t('Login Lightbox Title.'),
      '#translatable' => TRUE,
    ];

    $default_login_username = $this->get('login_username');
    $form['login_form']['login_username'] = [
      '#type' => 'textfield',
      '#title' => t('Username'),
      '#default_value' => $default_login_username,
      '#description' => $this->t('Username label.'),
      '#translatable' => TRUE,
    ];

    $default_login_password = $this->get('login_password');
    $form['login_form']['login_password'] = [
      '#type' => 'textfield',
      '#title' => t('Password'),
      '#default_value' => $default_login_password,
      '#description' => $this->t('Password Label.'),
      '#translatable' => TRUE,
    ];

    $default_remember_username = $this->get('login_remember_username');
    $form['login_form']['login_remember_username'] = [
      '#type' => 'textfield',
      '#title' => t('Remember Username'),
      '#default_value' => $default_remember_username,
      '#description' => $this->t('Remember Username label.'),
      '#translatable' => TRUE,
    ];

    $default_submit = $this->get('login_submit_button');
    $form['login_form']['login_submit_button'] = [
      '#type' => 'textfield',
      '#title' => t('Login Submit Button'),
      '#default_value' => $default_submit,
      '#description' => $this->t('Login Submit Button label that initiates login.'),
      '#translatable' => TRUE,
    ];

    $default_forgot_password = $this->get('login_forgot_password');
    $form['login_form']['login_forgot_password'] = [
      '#type' => 'textfield',
      '#title' => t('Forgot Password Link Label'),
      '#default_value' => $default_forgot_password,
      '#description' => $this->t('Forgot Password link label.'),
      '#translatable' => TRUE,
    ];

    $default_forgot_password_link = $this->get('login_forgot_password_link');
    $form['login_form']['login_forgot_password_link'] = [
      '#type' => 'textfield',
      '#title' => t('Forgot Password Link'),
      '#default_value' => $default_forgot_password_link,
      '#description' => $this->t('Forgot Password link.'),
      '#translatable' => TRUE,
    ];

    $default_registration = $this->get('login_registration');
    $form['login_form']['login_registration'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Link Label'),
      '#default_value' => $default_registration,
      '#description' => $this->t('Registration link label.'),
      '#translatable' => TRUE,
    ];

    $default_registration_link = $this->get('login_registration_link');
    $form['login_form']['login_registration_link'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Link'),
      '#default_value' => $default_registration_link,
      '#description' => $this->t('Registration link.'),
      '#translatable' => TRUE,
    ];

    $form['login_pt_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Playtech Settings'),
    ];

    $default_pt_casino_name = $this->get('login_pt_casino_name');
    $form['login_pt_settings']['login_pt_casino_name'] = [
      '#type' => 'textfield',
      '#title' => t('Casino Name'),
      '#default_value' => $default_pt_casino_name,
      '#translatable' => FALSE,
    ];

    $default_pt_secret_key = $this->get('login_pt_secret_key');
    $form['login_pt_settings']['login_pt_secret_key'] = [
      '#type' => 'textfield',
      '#title' => t('Secret Key'),
      '#default_value' => $default_pt_secret_key,
      '#description' => $this->t('Secret key to be used for integrating with playtech web apis.'),
      '#translatable' => FALSE,
    ];

    $default_pt_getbalance_url = $this->get('login_pt_getbalance_url');
    $form['login_pt_settings']['login_pt_getbalance_url'] = [
      '#type' => 'textfield',
      '#title' => t('Playtech Getbalance API URL'),
      '#default_value' => $default_pt_getbalance_url,
      '#description' => $this->t('URL to be used to get player balance.'),
      '#translatable' => FALSE,
    ];

    $default_pt_cashier_url = $this->get('login_pt_cashier_url');
    $form['login_pt_settings']['login_pt_cashier_url'] = [
      '#type' => 'textfield',
      '#title' => t('Playtech Cashier URL'),
      '#default_value' => $default_pt_cashier_url,
      '#description' => $this->t('Playtech Cashier URL.'),
      '#translatable' => FALSE,
    ];

    $default_pt_error_messages = $this->get('login_pt_error_messages');
    $form['login_pt_settings']['login_pt_error_messages'] = [
      '#type' => 'textarea',
      '#title' => t('Playtech error messages'),
      '#default_value' => $default_pt_error_messages,
      '#description' => $this->t('Mapping for error messages from playtech. Format errorCode|errorMessage'),
      '#translatable' => TRUE,
    ];

    $form['login_error_messages'] = [
      '#type' => 'details',
      '#title' => $this->t('Login Error Messages'),
    ];

    $default_username_required = $this->get('login_username_required');
    $form['login_error_messages']['login_username_required'] = [
      '#type' => 'textfield',
      '#title' => t('Username required'),
      '#default_value' => $default_username_required,
      '#description' => $this->t('Username required error message.'),
      '#translatable' => TRUE,
    ];

    $default_password_required = $this->get('login_password_required');
    $form['login_error_messages']['login_password_required'] = [
      '#type' => 'textfield',
      '#title' => t('Password required'),
      '#default_value' => $default_password_required,
      '#description' => $this->t('Password required error message.'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionLoginSessionConfig(array &$form) {
    $form['login_session'] = [
      '#type' => 'details',
      '#title' => $this->t('Login Session Configuration'),
    ];

    $default_login_session_time = $this->get('login_session_time');
    $form['login_session']['login_session_time'] = [
      '#type' => 'textfield',
      '#title' => t('Session Timer'),
      '#default_value' => $default_login_session_time,
      '#description' => $this->t('Login Session Time in Minutes'),
      '#translatable' => FALSE,
    ];

    $default_session_timeout = $this->get('session_timeout');
    $form['login_session']['session_timeout'] = [
      '#type' => 'textfield',
      '#title' => t('Session Timeout Error Message'),
      '#default_value' => $default_session_timeout,
      '#description' => $this->t('Session Timeout Error Message'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionChangePassConfig(array &$form) {
    $form['change_pass'] = [
      '#type' => 'details',
      '#title' => $this->t('Change Password Configuration'),
    ];

    $default_form_title = $this->get('change_pass_form_title');
    $form['change_pass']['change_pass_form_title'] = [
      '#type' => 'textfield',
      '#title' => t('Change Password Form Title'),
      '#default_value' => $default_form_title,
      '#description' => $this->t('Current Password Form Title'),
      '#translatable' => TRUE,
    ];

    $default_current_password = $this->get('change_pass_current_password');
    $form['change_pass']['change_pass_current_password'] = [
      '#type' => 'textfield',
      '#title' => t('Current Password Field Label'),
      '#default_value' => $default_current_password,
      '#description' => $this->t('Current Password Field Label'),
      '#translatable' => TRUE,
    ];

    $default_new_password = $this->get('change_pass_new_password');
    $form['change_pass']['change_pass_new_password'] = [
      '#type' => 'textfield',
      '#title' => t('New Password Field Label'),
      '#default_value' => $default_new_password,
      '#description' => $this->t('New Password Field Label'),
      '#translatable' => TRUE,
    ];

    $default_confirm_new_password = $this->get('change_pass_confirm_new_password');
    $form['change_pass']['change_pass_confirm_new_password'] = [
      '#type' => 'textfield',
      '#title' => t('Confirm New Password Field Label'),
      '#default_value' => $default_confirm_new_password,
      '#description' => $this->t('Confirm New Password Field Label'),
      '#translatable' => TRUE,
    ];

    $default_submit = $this->get('change_pass_submit');
    $form['change_pass']['change_pass_submit'] = [
      '#type' => 'textfield',
      '#title' => t('Submit button label'),
      '#default_value' => $default_confirm_new_password,
      '#description' => $this->t('Submit button label'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionChangePassErrorMessages(array &$form) {
    $form['change_pass_error_messages'] = [
      '#type' => 'details',
      '#title' => $this->t('Change Password Error Messages'),
    ];

    $default_cp_old_password_required = $this->get('change_pass_old_password_error');
    $form['change_pass_error_messages']['change_pass_old_password_error'] = [
      '#type' => 'textfield',
      '#title' => t('Change Password Old Password error message.'),
      '#default_value' => $default_cp_old_password_required,
      '#description' => $this->t('Change Password Old Password error message.'),
      '#translatable' => TRUE,
    ];

    $default_cp_new_password_required = $this->get('change_pass_new_password_error');
    $form['change_pass_error_messages']['change_pass_new_password_error'] = [
      '#type' => 'textfield',
      '#title' => t('Change Password New Password error message.'),
      '#default_value' => $default_cp_new_password_required,
      '#description' => $this->t('Change Password New Password error message.'),
      '#translatable' => TRUE,
    ];

    $default_cp_confirm_new_password_required = $this->get('change_pass_confirm_new_password_error');
    $form['change_pass_error_messages']['change_pass_confirm_new_password_error'] = [
      '#type' => 'textfield',
      '#title' => t('Change Password Confirm New Password error message.'),
      '#default_value' => $default_cp_confirm_new_password_required,
      '#description' => $this->t('Change Password Confirm New Password error message.'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
}
