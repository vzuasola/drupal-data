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

    return $form;
  }

  private function sectionLoginConfig(array &$form) {

    $form['login_form'] = [
      '#type' => 'details',
      '#title' => $this->t('Jamboree Login Form Configuration'),
    ];

    $default_login_button = $this->get('login_button');
    $form['login_form']['login_button'] = [
      '#type' => 'textfield',
      '#title' => t('Login Button'),
      '#default_value' => $default_login_button,
      '#description' => $this->t('Login Button label that triggers login lightbox.'),
      '#translatable' => TRUE,
    ];

    $default_login_button = $this->get('login_lightbox_title');
    $form['login_form']['login_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => t('Login Lightbox Title'),
      '#default_value' => $default_login_button,
      '#description' => $this->t('Login Lightbox Title.'),
      '#translatable' => TRUE,
    ];

    $default_login_button = $this->get('login_lightbox_title');
    $form['login_form']['login_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => t('Login Lightbox Title'),
      '#default_value' => $default_login_button,
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

    $default_pt_error_messages = $this->get('login_pt_error_messages');
    $form['login_error_messages']['login_pt_error_messages'] = [
      '#type' => 'textarea',
      '#title' => t('Playtech error messages'),
      '#default_value' => $default_pt_error_messages,
      '#description' => $this->t('Mapping for error messages from playtech. Format errorCode|errorMessage'),
      '#translatable' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
}
