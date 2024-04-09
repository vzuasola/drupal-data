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

    $this->headerConfiguration($form);
    $this->iCoreConfiguration($form);
    $this->successMessagesConfiguration($form);
    $this->passwordChecklistConfiguration($form);

    return $form;
  }

  /**
   * Header Configuration
   */
  private function headerConfiguration(&$form)
  {
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
  }

  /**
   * iCore configuration
   */
  private function iCoreConfiguration(&$form)
  {
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
  }

  /**
   * Success message configuration
   */
  private function successMessagesConfiguration(&$form)
  {
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
  }

  private function passwordChecklistConfiguration(&$form)
  {
    $form['field_password_validation_box'] = [
      '#type' => 'details',
      '#title' => 'Password Validation Box',
      '#group' => 'change_password',
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
