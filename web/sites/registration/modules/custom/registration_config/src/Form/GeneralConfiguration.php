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
      '#title' => $this->t('Settings'),
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
      '#description' => $this->t('Text that will be displayed at the top of the form'),
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

    $form['general']['home_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $config->get('home_title'),
      '#required' => TRUE,
    ];

    $form['general']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Title'),
      '#default_value' => $config->get('success_title'),
      '#required' => TRUE,
    ];

    $form['general']['geoip_to_default_currency_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Currency and Country base on Geo IP'),
      '#description' => $this->t('Mapping of default currency and country based on Geo IP ' .
        'registration form e.g. "PH|117,48" where PH is the Geo IP value, 117 is the ' .
        'default currency RMB and the 48 is the default country china'),
      '#default_value' => $config->get('geoip_to_default_currency_country'),
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
      '#default_value' => $config->get('registraton_portal_id_to_product_name'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_product_id_to_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID to product ID mapping'),
      '#description' => $this->t('Mapping that will be used for Product Type ID  to portal ID mapping upon registration e.g. "1|4,11,18" where 1 is the product type ID and the 4,11,18 is the portal IDs'),
      '#default_value' => $config->get('registraton_product_id_to_portal_id'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_portal_id_to_dafaconnect_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID to Dafabet connect portal ID mapping'),
      '#description' => $this->t('Mapping that will be used for Portal ID to dafa connect portal ID ' .
        'mapping upon registration e.g. "4|30" where 4 is the portal ID of casino and 30 is the casino ' .
        'connect portal ID. (Take note that the said mapping will override the regvia parameter on the url ' .
        'if the application detect that it is using a dafa-connect app)'),
      '#default_value' => $config->get('registraton_portal_id_to_dafaconnect_portal_id'),
      '#required' => TRUE,
    ];

    $form['restriction'] = [
      '#type' => 'details',
      '#title' => $this->t('Restriction'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['restriction']['portal_id_country_restriction'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country Restriction per Portal ID'),
      '#description' => $this->t('Mapping that will be used for restricting players after ' .
        'registration to view product-specific contents e.g. 24|27,39,23 where 24 is the ' .
        'portal ID of fish hunter and 27,39,23 are the icore country codes that was ' .
        'selected by the player. This will redirect the player on entrypage post-registration ' .
        'with notification that he is restricted on his selected country.'),
      '#default_value' => $config->get('portal_id_country_restriction'),
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
      'registraton_api_url',
      'registraton_portal_id_to_product_name',
      'registraton_product_id_to_portal_id',
      'registraton_portal_id_to_dafaconnect_portal_id',
      'success_title',
      'home_title',
      'portal_id_country_restriction',
      'geoip_to_default_currency_country',
    ];

    foreach ($keys as $key) {
      $this->config('registration_config.general_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
