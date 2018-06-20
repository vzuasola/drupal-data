<?php

namespace Drupal\my_account_error_handler\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account - Access Denied.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_error_handler.403",
 *   route = {
 *     "title" = "Access Denied Configuration",
 *     "path" = "/admin/config/my_account/access_denied",
 *   },
 *   menu = {
 *     "title" = "Access Denied",
 *     "description" = "My Account - Access Denied configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountAccessDeniedForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

    return ['my_account_error_handler.403'];
  }

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['access_denied'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'access_denied',
    ];

    $form['field_configuration']['access_denied']['top_blurb'] = [
      '#type' => 'textarea',
      '#title' => t('Top Blurb'),
      '#required' => TRUE,
      '#description' => $this->t('Top Blurb'),
      '#default_value' => $this->get('top_blurb'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['access_denied']['bottom_blurb'] = [
      '#type' => 'textarea',
      '#title' => t('Bottom Blurb'),
      '#required' => TRUE,
      '#description' => $this->t('Bottom Blurb'),
      '#default_value' => $this->get('bottom_blurb'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
