<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Can't Login COnfiguration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "cant_login_config",
 *   route = {
 *     "title" = "Can't Login Configuration",
 *     "path" = "/admin/config/my-account/cant-login",
 *   },
 *   menu = {
 *     "title" = "Can't Login",
 *     "description" = "Can't Login Configuration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class CantLoginConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['account_config.cant_login'];
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
    $this->passwordChecklistRules($form);

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

    $form['cant_login_general_config']['cant_login_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Can't login Header Title"),
      '#default_value' => $this->get('cant_login_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['cant_login_general_config']['reset_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reset Password Header Title'),
      '#default_value' => $this->get('reset_title'),
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
      '#title' => t("Integration"),
      '#group' => 'my_account_group',
    ];

    $form['cant_login_integration_config']['cant_login_response_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Response Code Mapping'),
      '#required' => TRUE,
      '#description' => $this->t('Cant Login API Response Code Mapping'),
      '#default_value' => $this->get('cant_login_response_mapping'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * Can't login - Tab Menu Configuration.
   */
  private function tabMenuConfig(&$form) {
    $form['cant_login_tab_menu_config'] = [
      '#type' => 'details',
      '#title' => t("Tab Menu"),
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
      '#title' => $this->t('Success Message'),
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
      '#title' => t("Reset Password"),
      '#group' => 'my_account_group',
    ];

    $content = $this->get('desktop_reset_password_success_message');
    $form['cant_login_reset_password_config']['desktop_reset_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('desktop_reset_expired_message');
    $form['cant_login_reset_password_config']['desktop_reset_expired_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Expired Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  private function passwordChecklistRules(&$form) {
    $form['field_password_validation_box'] = [
      '#type' => 'details',
      '#title' => 'Password Validation Box',
      '#group' => 'my_account_group',
    ];

    $form['field_password_validation_box']['min_max_length'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Minimum and Maximum Length'),
      '#description' => $this->t('Add text that will be shown in box for minimum and maximum lenght'),
      '#default_value' => $this->get('min_max_length'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['one_uppercase_letter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Uppercase Letter Field'),
      '#description' => $this->t('Here we should display text to user for one uppercase letter.'),
      '#default_value' => $this->get('one_uppercase_letter'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['one_lowercase_letter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lowercase Letter Field'),
      '#description' => $this->t('Here we should display text to user for one lowercase letter.'),
      '#default_value' => $this->get('one_lowercase_letter'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['number_symbol'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Number Symbol'),
      '#description' => $this->t('Add text that will be shown in box for number symbol that us required by user.'),
      '#default_value' => $this->get('number_symbol'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['username_password_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username Field and Banned Words'),
      '#description' => $this->t('Add text that will inform a user that the password cannot be the same with the selected username or contain any words from the blacklist.'),
      '#default_value' => $this->get('username_password_value'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['username_password_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username Field and Banned Words'),
      '#description' => $this->t('Add text that will inform a user that the password cannot be the same with the selected username or contain any words from the blacklist.'),
      '#default_value' => $this->get('username_password_value'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['new_and_confirm_must_match'] = [
      '#type' => 'textfield',
      '#title' => $this->t('New and Confirm Passwords must match'),
      '#description' => $this->t('Add message that will show user that new and confirm password must not match.'),
      '#default_value' => $this->get('new_and_confirm_must_match'),
      '#required' => true,
      '#translatable' => true
    ];

    $form['field_password_validation_box']['enable_new_password_validation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable New password validation'),
      '#description' => $this->t('If we check this checkbox new password validation will be active.'),
      '#default_value' => $this->get('enable_new_password_validation'),
      '#translatable' => true
    ];
  }
}
