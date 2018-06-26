<?php

namespace Drupal\my_account_error_handler\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account - Page Not Found.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_error_handler.404",
 *   route = {
 *     "title" = "Page not found Configuration",
 *     "path" = "/admin/config/my_account/page_not_found",
 *   },
 *   menu = {
 *     "title" = "Page Not Found",
 *     "description" = "My Account - Page not found configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountPageNotFoundForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_error_handler.404'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['page_not_found'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'page_not_found',
      '#open' => TRUE,
    ];

    $form['field_configuration']['top_blurb'] = [
      '#type' => 'textarea',
      '#title' => t('Top Blurb'),
      '#required' => TRUE,
      '#description' => $this->t('Top Blurb'),
      '#default_value' => $this->get('top_blurb'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['bottom_blurb'] = [
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
