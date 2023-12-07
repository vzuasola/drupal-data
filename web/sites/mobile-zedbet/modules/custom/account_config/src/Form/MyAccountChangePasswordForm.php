<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Change Password configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "change_password_form",
 *   route = {
 *     "title" = "Change Password Form",
 *     "path" = "/admin/config/my-account/change-password",
 *   },
 *   menu = {
 *     "title" = "Change Password Form Configuration",
 *     "description" = "Change Password Form COnfiguration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class MyAccountChangePasswordForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['account_config.general_configuration'];
  }

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['change_password'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['header_configuration'] = [
      '#type' => 'details',
      '#title' => 'Header Configuration',
      '#open' => False,
      '#group' => 'change_password',
    ];

    $form['header_configuration']['cp_page_title'] = [
        '#type' => 'textfield',
        '#title' => t('Page title'),
        '#required' => TRUE,
        '#description' => $this->t('Page title shown on the browser tab.'),
        '#default_value' => $this->get('cp_page_title'),
        '#translatable' => TRUE,
    ];

    $form['field_icore_validation'] = [
      '#type' => 'details',
      '#title' => 'Integration Validation',
      '#group' => 'change_password',
    ];

    $form['field_icore_validation']['integration_error'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Integration Error Messages'),
      '#description' => $this->t('Integration error list.'),
      '#default_value' => $this->get('integration_error'),
      '#translatable' => TRUE,
    ];

    $form['field_success_message_group'] = [
      '#type' => 'details',
      '#title' => 'Response Messages',
      '#group' => 'change_password',
    ];

    $content = $this->get('change_password_success_message');
    $form['field_success_message_group']['change_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('change_password_failed_message');
    $form['field_success_message_group']['change_password_failed_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Failed Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['field_password_validation_box'] = [
      '#type' => 'details',
      '#title' => 'Password Validation Box',
      '#group' => 'change_password',
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

    $form['field_password_validation_box']['not_same_as_old_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password can not be same as current password'),
      '#description' => $this->t('Add message that will show user that he can not use old password.'),
      '#default_value' => $this->get('not_same_as_old_password'),
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

    return $form;
  }

}
