<?php

namespace Drupal\my_account_form\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Can't Login COnfiguration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "cant_login_config",
 *   route = {
 *     "title" = "Can't Login Configuration",
 *     "path" = "/admin/config/my_account/cant-login",
 *   },
 *   menu = {
 *     "title" = "Can't Login",
 *     "description" = "Can't Login Configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class CantLoginConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_core.cant_login'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['my_account_group'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->generalConfig($form);
    $this->integrationConfig($form);
    $this->tabMenuConfig($form);
    $this->resetPasswordConfig($form);

    return $form;
  }

  /**
   * General Configuration for can't login.
   */
  private function generalConfig(&$form) {

    $form['cant_login_general_config'] = [
      '#type' => 'details',
      '#title' => t("General Configuration"),
      '#group' => 'my_account_group',
    ];

    $content = $this->get('page_subtitle');
    $form['cant_login_general_config']['page_subtitle'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Sub-Title'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Integration Configuration.
   */
  private function integrationConfig(&$form) {
    $form['cant_login_integration_config'] = [
      '#type' => 'details',
      '#title' => t("Integration Configuraiton"),
      '#group' => 'my_account_group',
    ];

    $form['cant_login_integration_config']['cant_login_response_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Response Code Mapping'),
      '#required' => TRUE,
      '#description' => $this->t('Cant Login API Response Code Mapping'),
      '#default_value' => $this->get('cant_login_response_mapping'),
    ];
  }

  /**
   * Can't login - Tab Menu Configuration.
   */
  private function tabMenuConfig(&$form) {
    $form['cant_login_tab_menu_config'] = [
      '#type' => 'details',
      '#title' => t("Tab Menu Configuraiton"),
      '#group' => 'my_account_group',
    ];

    $form['cant_login_tab_menu_config']['forgot_password'] = [
      '#type' => 'details',
      '#title' => 'Forgot Password',
      '#open' => FALSE,
    ];

    $form['cant_login_tab_menu_config']['forgot_password']['forgot_password_tab_menu'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Title',
      '#default_value' => $this->get('forgot_password_tab_menu'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['cant_login_tab_menu_config']['forgot_password']['forgot_password_link'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Link',
      '#default_value' => $this->get('forgot_password_link'),
      '#required' => TRUE,
    ];

    $content = $this->get('desktop_forgot_password_success_message');
    $form['cant_login_tab_menu_config']['forgot_password']['desktop_forgot_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Desktop Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('mobile_forgot_password_success_message');
    $form['cant_login_tab_menu_config']['forgot_password']['mobile_forgot_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Mobile Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['cant_login_tab_menu_config']['forgot_username'] = [
      '#type' => 'details',
      '#title' => 'Forgot Username',
      '#open' => FALSE,
    ];

    $form['cant_login_tab_menu_config']['forgot_username']['forgot_username_tab_menu'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Title',
      '#default_value' => $this->get('forgot_username_tab_menu'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['cant_login_tab_menu_config']['forgot_username']['forgot_username_link'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Link',
      '#default_value' => $this->get('forgot_username_link'),
      '#required' => TRUE,
    ];

    $content = $this->get('desktop_forgot_username_success_message');
    $form['cant_login_tab_menu_config']['forgot_username']['desktop_forgot_username_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Desktop Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('mobile_forgot_username_success_message');
    $form['cant_login_tab_menu_config']['forgot_username']['mobile_forgot_username_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Mobile Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Reset Password Configuration.
   */
  private function resetPasswordConfig(&$form) {
    $form['cant_login_reset_password_config'] = [
      '#type' => 'details',
      '#title' => t("Reset Password Configuraiton"),
      '#group' => 'my_account_group',
    ];

    $content = $this->get('reset_password_success_message');
    $form['cant_login_reset_password_config']['reset_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}
