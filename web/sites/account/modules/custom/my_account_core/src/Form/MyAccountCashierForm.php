<?php

namespace Drupal\my_account_core\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Cashier domain mapping configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_core.cashier",
 *   route = {
 *     "title" = "Cashier Configuration",
 *     "path" = "/admin/config/my_account/cashier",
 *   },
 *   menu = {
 *     "title" = "My Account Cashier",
 *     "description" = "Cashier domain mapping",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountCashierForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

    return ['my_account_core.cashier'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['cashier'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'cashier',
    ];

    $form['field_configuration']['cashier_domain_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Cashier Domain Mapping'),
      '#required' => TRUE,
      '#description' => $this->t('Cashier Domain Mapping'),
      '#default_value' => $this->get('cashier_domain_mapping'),
    ];

    return $form;
  }

}
