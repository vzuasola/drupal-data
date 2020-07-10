<?php

namespace Drupal\registration_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration for Registration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "registration_general_config",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/registration/general",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "General Configuration for Registration",
 *     "parent" = "registration_config.list",
 *   },
 * )
 */
class GeneralConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['registration_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Settings'),
    ];

    $this->generalConfig($form);
    $this->jpayIntegration($form);
    $this->errorConfig($form);
    $this->restrictionConfig($form);

    return $form;
  }

  /**
   * General Configuration for Registration.
   */
  private function generalConfig(array &$form) {
    $form['general_settings_tab']['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
    ];

    $form['general_settings_tab']['general']['step_one_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step one text'),
      '#description' => $this->t('Text that will be displayed at the top of the form'),
      '#default_value' => $this->get('step_one_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_settings_tab']['general']['home_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $this->get('home_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_settings_tab']['general']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Title'),
      '#default_value' => $this->get('success_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_settings_tab']['general']['geoip_to_default_currency_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Currency and Country base on Geo IP'),
      '#description' => $this->t('Mapping of default currency and country based on Geo IP ' .
        'registration form e.g. "PH|117,48" where PH is the Geo IP value, 117 is the ' .
        'default currency RMB and the 48 is the default country china'),
      '#default_value' => $this->get('geoip_to_default_currency_country'),
      '#required' => TRUE,
    ];

    $form['general_settings_tab']['general']['native_app_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Native App Page Title'),
      '#description' => $this->t('Header text above the form for native app'),
      '#default_value' => $this->get('native_app_title'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];
    $form['general_settings_tab']['general']['enable_reg_relic_custom_headers'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Registration Relic Custom Headers'),
      '#description' => $this->t('If this is checked, this will include custom headers to be passed on REG API'),
      '#default_value' => $this->get('enable_reg_relic_custom_headers'),
    ];
  }

  /**
   * Restriction Config for Registration.
   */
  private function restrictionConfig(array &$form) {
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
      '#default_value' => $this->get('portal_id_country_restriction'),
      '#required' => TRUE,
    ];

    $form['restriction']['portal_id_to_product_name_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Portal ID to Product Name Mapping'),
      '#description' => $this->t('Mapping that will be used in getting the ' .
        'product name for each portal ID registered which is translatable.'),
      '#default_value' => $this->get('portal_id_to_product_name_mapping'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['restriction']['country_restriction_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country Restriction Message'),
      '#description' => $this->t('Message that will appear on step 2 after successful ' .
        'registration that the player is restricted on the country that he selected ' .
        'you can use the "[product]" as a placeholder to specify the product he is ' .
        'restricted to.'),
      '#default_value' => $this->get('country_restriction_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['restriction']['mbtc_product_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Portal ID'),
      '#description' => $this->t('Portal ID of Product that support mBTC currency.'),
      '#default_value' => $this->get('mbtc_product_portal_id'),
      '#required' => TRUE,
    ];

    $form['restriction']['mbtc_restriction_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency Restriction Message'),
      '#default_value' => $this->get('mbtc_restriction_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Error Configuration for Registration.
   */
  private function errorConfig(array &$form) {
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
      '#default_value' => $this->get('generic_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['error_settings']['error_code_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Code Mapping'),
      '#description' => $this->t('Mapping of error codes returned by reg API, ' .
        'particularly the error codes returned by icore which cannot be handled by ' .
        'the registration form itself e.g ExternalPlayerAccountCreationFailed|-20. ' .
        'where ExternalPlayerAccountCreationFailed is the icore status code and -20 ' .
        'is the error code that will appear beside the generic error message'),
      '#default_value' => $this->get('error_code_mapping'),
      '#required' => TRUE,
    ];
    $form['error_settings']['unauthenticated_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unauthenticated Form Error Message'),
      '#description' => $this->t('Unauthenticated error form message that will appear at the top of ' .
        'the form if the player is not successfully authenticated after successful registration.'),
      '#default_value' => $this->get('unauthenticated_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['error_settings']['forbidden_request_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration API forbidden request error message'),
      '#default_value' => $this->get('forbidden_request_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * JPay Integration Config.
   */
  private function jpayIntegration(&$form) {
    $form['jpay_integration'] = [
      '#type' => 'details',
      '#title' => $this->t('JPay Integration'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['jpay_integration']['jpay_api'] = [
      '#type' => 'textarea',
      '#title' => $this->t('JPAY API Endpoint'),
      '#description' => $this->t('Endpoint for JPAY API'),
      '#default_value' => $this->get('jpay_api') ?? "PRD|http://cms-jpayws.games.prd/api/cashier/",
      '#translatable' => TRUE,
    ];

    $form['jpay_integration']['jpay_siteid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPay Site ID'),
      '#description' => $this->t('JPay Site ID for nextbet'),
      '#default_value' => $this->get('jpay_siteid') ?? 106,
      '#translatable' => TRUE,
    ];
  }
}
