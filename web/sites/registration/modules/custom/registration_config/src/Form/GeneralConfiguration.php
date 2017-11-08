<?php

namespace Drupal\registration_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Header Configuration.
 */
class GeneralConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['registration_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'general_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('registration_config.general_configuration');

    $form['general_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['general']['step_one_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step one text'),
      '#description' => $this->t('Text that will be displayed at the top of the form '),
      '#default_value' => $config->get('step_one_text'),
      '#required' => TRUE,
    ];

    $form['general']['step_two_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step two text'),
      '#description' => $this->t('Text that will be displayed at the top of step 2 banner'),
      '#default_value' => $config->get('step_two_text'),
      '#required' => TRUE,
    ];

    $form['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['integration']['registraton_api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration API URL'),
      '#description' => $this->t('Endpoint for registration API'),
      '#default_value' => $config->get('registraton_api_url'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_portal_id_to_product_name'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID mapping to product name'),
      '#description' => $this->t('Mapping that will be used for portal ID to Product Name e.g. 2|dafabet-entry'),
      '#default_value' => $config->get('registraton_api_url'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_product_id_to_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID to product ID mapping'),
      '#description' => $this->t('Mapping that will be used for Product Type ID  to portal ID mapping upon registration e.g. "1|4,11,18" where 1 is the product type ID and the 4,11,18 is the portal IDs'),
      '#default_value' => $config->get('registraton_api_url'),
      '#required' => TRUE,
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'step_one_text',
      'step_two_text',
    ];

    foreach ($keys as $key) {
      $this->config('registration_config.general_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
