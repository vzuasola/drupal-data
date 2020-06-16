<?php

namespace Drupal\mobile_nextbet\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_nextbet",
 *   route = {
 *     "title" = "Mobile Nextbet Configuration",
 *     "path" = "/admin/config/mobile/nextbet/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Nextbet Configuration",
 *     "description" = "Provides configuration for Nextbet",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileNextbetForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_nextbet.nextbet_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Nextbet Configuration'),
    ];

    $this->sectionNextbetConfigs($form);
    $this->generalConfig($form);
    $this->restrictionConfig($form);

    return $form;
  }

  private function sectionNextbetConfigs(array &$form) {
    $form['nextbet_configuration'] = [
      '#type' => 'details',
      '#title' => t('Nextbet Configuration'),
      '#group' => 'advanced',
    ];

    $form['nextbet_configuration']['all_apps_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View All Apps Here'),
      '#default_value' => $this->get('all_apps_text'),
      '#translatable' => TRUE,
    ];

    $form['nextbet_configuration']['view_less_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View Less Here'),
      '#default_value' => $this->get('view_less_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['download_app_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download App Here'),
      '#default_value' => $this->get('download_app_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['contact_us_home_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Here'),
      '#default_value' => $this->get('contact_us_home_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['parnerts_and_sponsor_title_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Partners and Sponsors Here'),
      '#default_value' => $this->get('parnerts_and_sponsor_title_text'),
      '#translatable' => true,
    ];
  }

  /**
   * General Configuration for Registration.
   */
  private function generalConfig(array &$form) {
    $form['general_settings_tab']['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
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
      '#group' => 'advanced',
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
}
