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
    $this->integrationConfig($form);
    $this->restrictionConfig($form);
    $this->errorConfig($form);
    $this->proactiveConfig($form);
    $this->cashierConfig($form);
    $this->logConfig($form);
    $this->trackingConfig($form);
    $this->tripwirePopupConfig($form);

    return $form;
  }

  /**
   * General Configuration for Registration.
   */
  private function generalConfig(array &$form) {
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
      '#default_value' => $this->get('step_one_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general']['step_two_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step two text'),
      '#description' => $this->t('Text that will be displayed at the top of step 2 banner'),
      '#default_value' => $this->get('step_two_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general']['home_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Title'),
      '#default_value' => $this->get('home_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Title'),
      '#default_value' => $this->get('success_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general']['geoip_to_default_currency_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Currency and Country base on Geo IP'),
      '#description' => $this->t('Mapping of default currency and country based on Geo IP ' .
        'registration form e.g. "PH|117,48" where PH is the Geo IP value, 117 is the ' .
        'default currency RMB and the 48 is the default country china'),
      '#default_value' => $this->get('geoip_to_default_currency_country'),
      '#required' => TRUE,
    ];

    $form['general']['native_app_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Native App Page Title'),
      '#description' => $this->t('Header text above the form for native app'),
      '#default_value' => $this->get('native_app_title'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];
    $form['general']['enable_reg_relic_custom_headers'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Registration Relic Custom Headers'),
      '#description' => $this->t('If this is checked, this will include custom headers to be passed on REG API'),
      '#default_value' => $this->get('enable_reg_relic_custom_headers'),
    ];
  }

  /**
   * Integration Config.
   */
  private function integrationConfig(array &$form) {
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
      '#default_value' => $this->get('registraton_api_url'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_portal_id_to_product_name'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID mapping to product name'),
      '#description' => $this->t('Mapping that will be used for portal ID to Product Name e.g. 2|dafabet-entry'),
      '#default_value' => $this->get('registraton_portal_id_to_product_name'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_product_id_to_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID to product ID mapping'),
      '#description' => $this->t('Mapping that will be used for Product Type ID  to portal ID mapping upon registration e.g. "1|4,11,18" where 1 is the product type ID and the 4,11,18 is the portal IDs'),
      '#default_value' => $this->get('registraton_product_id_to_portal_id'),
      '#required' => TRUE,
    ];

    $form['integration']['registraton_portal_id_to_dafaconnect_portal_id'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Portal ID to Dafabet connect portal ID mapping'),
      '#description' => $this->t('Mapping that will be used for Portal ID to dafa connect portal ID ' .
        'mapping upon registration e.g. "4|30" where 4 is the portal ID of casino and 30 is the casino ' .
        'connect portal ID. (Take note that the said mapping will override the regvia parameter on the url ' .
        'if the application detect that it is using a dafa-connect app)'),
      '#default_value' => $this->get('registraton_portal_id_to_dafaconnect_portal_id'),
      '#required' => TRUE,
    ];

    $form['integration']['mobile_native_app_command'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Native App CMD'),
      '#description' => $this->t('Mobile Native App Command that will run after successful Registration'),
      '#default_value' => $this->get('mobile_native_app_command'),
      '#required' => TRUE,
    ];
    $form['integration']['enable_futurama_authentication_poker'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Futarama Poker client authentication'),
      '#description' => $this->t('This will enable futurama authentication for Poker and will use that legacy ' .
        'if unchecked'),
      '#default_value' => $this->get('enable_futurama_authentication_poker'),
    ];
    $form['integration']['enable_futurama_authentication_casino'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Futarama Casino client authentication'),
      '#description' => $this->t('This will enable futurama authentication for Casino and will use that legacy ' .
        'if unchecked'),
      '#default_value' => $this->get('enable_futurama_authentication_casino'),
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
  }

  /**
   * Proactive Livechat COnfiguration.
   */
  private function proactiveConfig(array &$form) {
    $form['proactive_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Proactive Livechat'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['proactive_settings']['enable_avaya_proactive'] = [
      '#type' => 'number',
      '#title' => $this->t('Enable Proactive Livechat'),
      '#description' => $this->t('Input 1 to enable avaya proactive, 0 to disable'),
      '#default_value' => $this->get('enable_avaya_proactive'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['livechat_timeout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Timeout Proactive livechat'),
      '#description' => $this->t('Amount of time the live chat will show (in seconds)'),
      '#default_value' => $this->get('livechat_timeout'),
      '#required' => TRUE,
    ];
    $form['proactive_settings']['livechat_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Header Text'),
      '#description' => $this->t('Text that will be displayed at the top of the chatbox'),
      '#default_value' => $this->get('livechat_header'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['livechat_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Text'),
      '#description' => $this->t('Text that will be displayed inside the chatbox'),
      '#default_value' => $this->get('livechat_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['livechat_kr_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Person KR URL'),
      '#description' => $this->t('Live person link for KR Language (this will always override the current avaya KR URL)'),
      '#default_value' => $this->get('livechat_kr_link'),
      '#required' => TRUE,
    ];
    $form['proactive_settings']['enable_proactive_mobile'] = [
      '#type' => 'number',
      '#title' => $this->t('Enable Proactive Mobile'),
      '#description' => $this->t('Input 1 to enable proactiveo Social App on Mobile, 0 to disable'),
      '#default_value' => $this->get('enable_proactive_mobile'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['proactive_mobile_timeout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Timeout Proactive Mobile'),
      '#description' => $this->t('Amount of time the Proactive mobile chat will show (in seconds)'),
      '#default_value' => $this->get('proactive_mobile_timeout'),
    ];
    $form['proactive_settings']['proactive_mobile_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proactive Mobile Class Icon'),
      '#description' => $this->t('Proactive mobile class icon to be used that will be shown to player'),
      '#default_value' => $this->get('proactive_mobile_class'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['proactive_mobile_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proactive Mobile URL'),
      '#description' => $this->t('Proactive mobile URL where the player will be redirected'),
      '#default_value' => $this->get('proactive_mobile_url'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['proactive_mobile_url_playstore'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proactive Mobile URL Play Store'),
      '#description' => $this->t('Proactive mobile URL playstore where the player will be redirected' .
        'if the app is not installed'),
      '#default_value' => $this->get('proactive_mobile_url_playstore'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['proactive_mobile_url_ios'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proactive Mobile URL iOS'),
      '#description' => $this->t('Proactive mobile URL for iOS (if applicable) where the player will be redirected'),
      '#default_value' => $this->get('proactive_mobile_url_ios'),
      '#translatable' => TRUE,
    ];
    $form['proactive_settings']['proactive_mobile_url_ios_appstore'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proactive Mobile URL iOS App Store'),
      '#description' => $this->t('Proactive mobile URL for iOS (if applicable) appstore where the player will be ' .
        'redirected if the app is not installed'),
      '#default_value' => $this->get('proactive_mobile_url_ios_appstore'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * Cashier Configuration.
   */
  private function cashierConfig(array &$form) {
    $form['cashier_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Cashier Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['cashier_settings']['enable_cashier_payment_methods'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Cashier Payment Methods'),
      '#description' => $this->t('Input 1 to enable Cashier Payment Methods on step 2, 0 to disable'),
      '#default_value' => $this->get('enable_cashier_payment_methods'),
      '#translatable' => TRUE,
    ];
    $form['cashier_settings']['deposit_now_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Deposit Now Button Text'),
      '#default_value' => $this->get('deposit_now_text'),
      '#translatable' => TRUE,
    ];
    $form['cashier_settings']['payment_method_headers'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Payment Method Headers'),
      '#description' => $this->t('Consist of 4 header, "Icon Header", "DescriptionHeader", ' .
        ' "Min/Max Header", and "Action Header". This will be separated by "|" character.'),
      '#default_value' => $this->get('payment_method_headers'),
      '#translatable' => TRUE,
    ];
    $withPaymentMethod = $this->get('with_payment_method');
    $form['cashier_settings']['with_payment_method'] = [
      '#type' => 'text_format',
      '#title' => $this->t('With Payment Method'),
      '#description' => $this->t("Message to be displayed if payment method is available."),
      '#default_value' => $withPaymentMethod['value'],
      '#format' => $withPaymentMethod['format'],
      '#translatable' => TRUE,
    ];
    $withoutPaymentMethod = $this->get('without_payment_method');
    $form['cashier_settings']['without_payment_method'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Without Payment Method'),
      '#description' => $this->t("Message to be displayed if payment method is not available."),
      '#default_value' => $withoutPaymentMethod['value'],
      '#format' => $withoutPaymentMethod['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   * Metrics Logging Configuration.
   */
  private function logConfig(array &$form) {
    $form['logging_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Metrics Logging'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['logging_settings']['enable_rs_logging'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable RS logging'),
      '#default_value' => $this->get('enable_rs_logging'),
    ];
  }

  /**
   * S2S tracking Configuration.
   */
  private function trackingConfig(array &$form) {
    $form['s2s_tracking'] = [
      '#type' => 'details',
      '#title' => $this->t('S2S tracking'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['s2s_tracking']['s2s_config'] = [
      '#type' => 'textarea',
      '#title' => $this->t('S2S Config'),
      '#description' => $this->t('Config of s2s implementation that will integrate to affiliate ' .
        'where the first parameter seperated by "|" symbol is the postback URL ' .
        'and the second parameter is the dynamic value from the query parameter  ' .
        'that will be passed along the URL'),
      '#default_value' => $this->get('s2s_config'),
    ];
  }

  /**
   * Tripwire Pop-up Configuration
   */
  private function tripwirePopupConfig(array &$form) {
    $form['tripwire_popup'] = [
      '#type' => 'details',
      '#title' => $this->t('Tripwire Popup'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['tripwire_popup']['enable_tripwire_popup'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Tripwire Popup'),
      '#description' => $this->t('Check to enable tripwire popup'),
      '#default_value' => $this->get('enable_tripwire_popup'),
      '#translatable' => TRUE,
    ];
    $form['tripwire_popup']['tripwire_popup_show_limit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show Limit'),
      '#description' => $this->t('Number of times popup will show'),
      '#default_value' => $this->get('tripwire_popup_show_limit') ?? 2,
      '#translatable' => FALSE,
    ];
    $content = $this->get('tripwire_popup_content');
    $form['tripwire_popup']['tripwire_popup_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t("Message to be displayed inside pop-up."),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#translatable' => TRUE,
    ];
  }
}
