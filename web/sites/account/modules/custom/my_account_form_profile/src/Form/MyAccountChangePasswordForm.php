<?php

namespace Drupal\my_account_form_profile\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Bonus History configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "change_password",
 *   route = {
 *     "title" = "My Account Change Password Form",
 *     "path" = "/admin/config/my_account/change_password",
 *   },
 *   menu = {
 *     "title" = "My Account Change Password Form",
 *     "description" = "My Account Change Password Form COnfiguration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountChangePasswordForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_form_profile.change_password'];
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
      '#title' => 'Mobile Response - Messages',
      '#group' => 'change_password',
    ];

    $content = $this->get('change_password_mobile_success_message');
    $form['field_success_message_group']['change_password_mobile_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('change_password_mobile_failed_message');
    $form['field_success_message_group']['change_password_mobile_failed_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Failed Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
