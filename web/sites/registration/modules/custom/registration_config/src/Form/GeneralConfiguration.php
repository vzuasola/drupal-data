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

    $form['restriction']['portal_id_to_product_name_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Portal ID to Product Name Mapping'),
      '#description' => $this->t('Mapping that will be used in getting the ' .
        'product name for each portal ID registered which is translatable.'),
      '#default_value' => $config->get('portal_id_to_product_name_mapping'),
      '#required' => TRUE,
    ];

    $form['restriction']['country_restriction_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country Restriction Message'),
      '#description' => $this->t('Message that will appear on step 2 after successful ' .
        'registration that the player is restricted on the country that he selected ' .
        'you can use the "[product]" as a placeholder to specify the product he is ' .
        'restricted to.'),
      '#default_value' => $config->get('country_restriction_message'),
      '#required' => TRUE,
    ];

    $form['error_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Error Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['error_settings']['generic_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Generic Form Error Message'),
      '#description' => $this->t('Generic error form message that will appear at the top of ' .
        'the form with appended error code on it. This will be used if there are unhandled ' .
        'exceptions on the form e.g unsupported currency on specific portal ID.'),
      '#default_value' => $config->get('generic_error_message'),
      '#required' => TRUE,
    ];
    $form['error_settings']['error_code_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Code Mapping'),
      '#description' => $this->t('Mapping of error codes returned by reg API, ' .
        'particularly the error codes returned by icore which cannot be handled by ' .
        'the registration form itself e.g ExternalPlayerAccountCreationFailed|-20. ' .
        'where ExternalPlayerAccountCreationFailed is the icore status code and -20 ' .
        'is the error code that will appear beside the generic error message'),
      '#default_value' => $config->get('error_code_mapping'),
      '#required' => TRUE,
    ];
    $form['error_settings']['unauthenticated_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unauthenticated Form Error Message'),
      '#description' => $this->t('Unauthenticated error form message that will appear at the top of ' .
        'the form if the player is not successfully authenticated after successful registration.'),
      '#default_value' => $config->get('unauthenticated_error_message'),
      '#required' => TRUE,
    ];

    $form['avaya_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Avaya Proactive Livechat'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['avaya_settings']['enable_avaya_proactive'] = [
      '#type' => 'number',
      '#title' => $this->t('Enable Proactive Livechat'),
      '#description' => $this->t('Input 1 to enable avaya proactive, 0 to disable'),
      '#default_value' => $config->get('enable_avaya_proactive'),
    ];
    $form['avaya_settings']['livechat_timeout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Timeout Proactive livechat'),
      '#description' => $this->t('Amount of time the live chat will show (in seconds)'),
      '#default_value' => $config->get('livechat_timeout'),
      '#required' => TRUE,
    ];
    $form['avaya_settings']['livechat_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Header Text'),
      '#description' => $this->t('Text that will be displayed at the top of the chatbox'),
      '#default_value' => $config->get('livechat_header'),
      '#required' => TRUE,
    ];
    $form['avaya_settings']['livechat_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Text'),
      '#description' => $this->t('Text that will be displayed inside the chatbox'),
      '#default_value' => $config->get('livechat_text'),
      '#required' => TRUE,
    ];

    $form['cashier_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Cashier Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['cashier_settings']['enable_cashier_payment_methods'] = [
      '#type' => 'number',
      '#title' => $this->t('Enable Cashier Payment Methods'),
      '#description' => $this->t('Input 1 to enable Cashier Payment Methods on step 2, 0 to disable'),
      '#default_value' => $config->get('enable_cashier_payment_methods'),
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
      'portal_id_to_product_name_mapping',
      'country_restriction_message',
      'geoip_to_default_currency_country',
      'generic_error_message',
      'error_code_mapping',
      'unauthenticated_error_message',
      'enable_avaya_proactive',
      'livechat_timeout',
      'livechat_header',
      'livechat_text',
      'enable_cashier_payment_methods',
    ];

    foreach ($keys as $key) {
      $this->config('registration_config.general_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
