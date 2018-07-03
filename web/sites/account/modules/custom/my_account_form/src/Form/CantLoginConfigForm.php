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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function generalConfig(&$form) {

    $form['cant_login_general_config'] = [
      '#type' => 'details',
      '#title' => t("Can't Login General Configuration"),
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
   * {@inheritdoc}
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
   * {@inheritdoc}
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
    ];

    $form['cant_login_tab_menu_config']['forgot_password']['forgot_password_link'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Link',
      '#default_value' => $this->get('forgot_password_link'),
    ];

    $content = $this->get('forgot_password_success_message');
    $form['cant_login_tab_menu_config']['forgot_password']['forgot_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
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
    ];

    $form['cant_login_tab_menu_config']['forgot_username']['forgot_username_link'] = [
      '#type' => 'textfield',
      '#title' => 'Tab Menu - Link',
      '#default_value' => $this->get('forgot_username_link'),
    ];

    $content = $this->get('forgot_username_success_message');
    $form['cant_login_tab_menu_config']['forgot_username']['forgot_username_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}
