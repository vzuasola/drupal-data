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
    $this->textOverBannerConfig($form);
    $this->panIdUrlConfiguration($form);

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
    $form['integration']['enable_futurama_native_app'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Futarama Native App authentication'),
      '#description' => $this->t('This will enable futurama authentication for Native App and will use that legacy ' .
        'if unchecked'),
      '#default_value' => $this->get('enable_futurama_native_app'),
    ];
    $form['integration']['enable_futurama_poker_native_app_back'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable back button in Poker Native App'),
      '#description' => $this->t('If checked, back button will be visible to the player.' .
        'if unchecked'),
      '#default_value' => $this->get('enable_futurama_poker_native_app_back'),
    ];
    $form['integration']['enable_futurama_authentication_poker_native_app'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Futarama Poker Native App authentication'),
      '#description' => $this->t('This will enable futurama authentication for Poker Native App and will use that legacy ' .
        'if unchecked'),
      '#default_value' => $this->get('enable_futurama_authentication_poker_native_app'),
    ];
    $form['integration']['ow_native_autologin_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('One Works Native App Autologin URL'),
      '#description' => $this->t('URL where we redirect the user for autologin after successful registration'),
      '#default_value' => $this->get('ow_native_autologin_url'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['integration']['cashier_url_native'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Native App Cashier URL'),
      '#description' => $this->t('This URL will be used if the native app needs a banking URL'),
      '#default_value' => $this->get('cashier_url_native'),
      '#required' => TRUE,
    ];
    $form['integration']['iovation_portal_ids'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Iovation Portal IDs'),
      '#description' => $this->t('portal IDs where will iovation be invoked'),
      '#default_value' => $this->get('iovation_portal_ids') ?? '22,123,26,128,29,131,48,141',
      '#required' => TRUE,
    ];
    $form['integration']['enable_reg_api_auth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Registration API Authentication'),
      '#description' => $this->t('tick the checkbox to enable pass headers to authenticate to Registration API'),
      '#default_value' => $this->get('enable_reg_api_auth')
    ];
    $form['integration']['reg_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration API Key'),
      '#description' => $this->t('Key that will be used for the authentication mechanism for Reg API'),
      '#default_value' => $this->get('reg_api_key'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['integration']['jpay_api'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPAY API Endpoint'),
      '#description' => $this->t('Endpoint for JPAY API'),
      '#default_value' => $this->get('jpay_api'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['integration']['jpay_siteid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPAY SiteId'),
      '#description' => $this->t('JPay Site ID'),
      '#default_value' => $this->get('jpay_siteid'),
      '#translatable' => TRUE,
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
    $form['tripwire_popup']['tripwire_popup_show_limit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show Limit'),
      '#description' => $this->t('Number of times popup will show'),
      '#default_value' => $this->get('tripwire_popup_show_limit') ?? 2,
    ];
    $form['tripwire_popup']['tripwire_popup_show_delay'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show Delay'),
      '#description' => $this->t('Delay before popup will show in milliseconds'),
      '#default_value' => $this->get('tripwire_popup_show_delay') ?? 3000,
    ];
  }

  /**
   * Text Over Banner Configuration
   */
  private function textOverBannerConfig(array &$form) {
    $form['text_over_banner'] = [
      '#type' => 'details',
      '#title' => $this->t('Text Over Banner'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $mobile = $this->get('text_over_banner_mobile');
    $form['text_over_banner']['text_over_banner_mobile'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Mobile'),
      '#description' => $this->t('Above content will display in mobile view.'),
      '#default_value' => $mobile['value'],
      '#format' => $mobile['format'],
      '#translatable' => TRUE,
    ];
    $tablet = $this->get('text_over_banner_tablet');
    $form['text_over_banner']['text_over_banner_tablet'] = [
      '#type' => 'text_format',
      '#title' => $this->t('<br><br> Tablet'),
      '#description' => $this->t('Above content will display in tablet view.'),
      '#default_value' => $tablet['value'],
      '#format' => $tablet['format'],
      '#translatable' => TRUE,
    ];
    $desktop_left = $this->get('text_over_banner_desktop_left');
    $form['text_over_banner']['text_over_banner_desktop_left'] = [
      '#type' => 'text_format',
      '#title' => $this->t('<br><br> Desktop Left Side'),
      '#description' => $this->t('Above content will display in desktop view on the left side.'),
      '#default_value' => $desktop_left['value'],
      '#format' => $desktop_left['format'],
      '#translatable' => TRUE,
    ];
    $desktop_right = $this->get('text_over_banner_desktop_right');
    $form['text_over_banner']['text_over_banner_desktop_right'] = [
      '#type' => 'text_format',
      '#title' => $this->t('<br><br> Desktop Right Side'),
      '#description' => $this->t('Above content will display in desktop view on the right side.'),
      '#default_value' => $desktop_right['value'],
      '#format' => $desktop_right['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   * Pan ID Configurations
   */
  private function panIdUrlConfiguration(array &$form)
  {
    $form['pan_id_url_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('PAN ID Configurations'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['pan_id_url_configuration']['upload_image_server'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Upload Image server'),
      '#description' => $this->t('Add upload image server URL'),
      '#default_value' => $this->get('upload_image_server') ?? "",
    ];
       $form['pan_id_url_configuration']['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image server secret key'),
      '#description' => $this->t('Here we should put image server secret key.'),
      '#default_value' => $this->get('secret_key') ?? "",
    ];
    $form['pan_id_url_configuration']['image_server_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image Server Name'),
      '#description' => $this->t('Here we should put name of image server.'),
      '#default_value' => $this->get('image_server_name') ?? "",
    ];
    $form['pan_id_url_configuration']['image_server_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image Server Password'),
      '#description' => $this->t('Enter password for image server for authentication during image upload.'),
      '#default_value' => $this->get('image_server_password') ?? "",
    ];

    $form['pan_id_url_configuration']['arion_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Arion endpoint URL'),
      '#description' => $this->t('Here we should add Arion endpoint that will process our image'),
      '#default_value' => $this->get('arion_endpoint') ?? "",
    ];

    $form['pan_id_url_configuration']['taurus_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Taurus wsdl endpoint URL'),
      '#description' => $this->t('We should add Taurus wsdl endpoint that will call on PAN ID creation'),
      '#default_value' => $this->get('taurus_endpoint') ?? "",
    ];

    $form['pan_id_url_configuration']['ocr_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('OCR endpoint'),
      '#description' => $this->t('Enter OCR endpoint for reading image upload.'),
      '#maxlength' => 500,
      '#default_value' => $this->get('ocr_endpoint') ?? "",
    ];
    $form['pan_id_url_configuration']['x_pan_id_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('X-PANID-Code of OCR endpoint'),
      '#description' => $this->t('Enter X-PANID-Code of OCR endpoint.'),
      '#default_value' => $this->get('x_pan_id_code') ?? "",
    ];
    $form['pan_id_url_configuration']['request_timeout'] = [
      '#type' => 'number',
      '#title' => $this->t('Request Timeout'),
      '#description' => $this->t('Input value for the request timeout'),
      '#default_value' => $this->get('request_timeout'),
    ];
  }
}
