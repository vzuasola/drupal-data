<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Playtech Provider Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "playtech_provider_settings_form",
 *   route = {
 *     "title" = "Playtech Provider Configuration",
 *     "path" = "/admin/config/webcomposer/games/playtech",
 *   },
 *   menu = {
 *     "title" = "Playtech Provider Configuration",
 *     "description" = "Provides configuration for Playtech game provider",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 8
 *   },
 * )
 */
class PlaytechProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Playtech Provider Configuration
   */
  /**
   * Playtech Provider Configuration
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_playtech_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_playtech_provider_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->integrationConfig($form['integration_config']);
    $this->errorHandlingConfig($form['error_handling_config']);
    $this->uglConfiguration($form['ugl_config']);
    return $form;
  }

  private function integrationConfig(&$form) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Integration Settings'),
      '#collapsible' => true,
      '#group' => 'games_playtech_provider_form',
      '#access' => !$this->isTranslated() // Hide the integration config since all fields are non translatable
    ];

    $form['javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get('javascript_assets'),
      '#required' => false,
    ];

    $form['playtech_pas_casino'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech PAS Casino'),
      '#description' => $this->t('Defines the casino value used for authenticating PAS'),
      '#default_value' => $this->get('playtech_pas_casino'),
      '#required' => false
    ];

    $form['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for Playtech games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#required' => false
    ];

    $form['iapiconf_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iapiConf Override'),
      '#description' => $this->t('Define iapiConf to be overrided prior PAS initalization
          <br>
          If no mapping specified, it will use the the default config from Playtech
          <br>
          <strong>clientUrl_casino|https://cachebanner.9bonus.com/casinoclient.html</strong>'),
      '#default_value' => $this->get('iapiconf_override'),
      '#required' => false
    ];
  }

  private function errorHandlingConfig(&$form) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Error Handling'),
      '#collapsible' => TRUE,
      '#group' => 'games_playtech_provider_form'
    ];

    $form['error_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Mapping'),
      '#description' => $this->t('Define error messages for corresponding PAS error codes<br/>
          pattern: <strong>code|message|custom_header_title</strong><br/>
          special codes: <br/>
           - <i>all</i>: Generic handler'),
      '#default_value' => $this->get('error_mapping'),
      '#rows' => 10,
      '#translatable' => true
    ];

    $form['error_header_title_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header title text'),
      '#description' => $this->t('Default header title for the error.'),
      '#default_value' => $this->get('error_header_title_text'),
      '#translatable' => true
    ];

    $form['error_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button text'),
      '#description' => $this->t('Button Text and link.
      <br/>Sample value: Ok|www.dafabet.com
      <br/>Empty 2nd part of | or |#close will close the lightbox.
      <br/>"|#reload" will reload the current page.
      <br/>Leave empty for no button'),
      '#default_value' => $this->get('error_button'),
      '#translatable' => true
    ];
  }

  private function uglConfiguration(&$form) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('UGL Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_playtech_provider_form'
    ];

    $form['ugl_switch'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable UGL Integration'),
      '#description' => $this->t('This will enable ugl features.'),
      '#default_value' => $this->get('ugl_switch'),
    ];

    $form['ugl_languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for ugl games launch. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('ugl_languages'),
      '#required' => false
    ];

    $form['ugl_currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t('Currency Mapping'),
      '#default_value' => $this->get('ugl_currency'),
      '#required' => false,
    ];

    $form['ugl_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL Configuration'),
      '#description' => $this->t('Defines the UGL endpoint'),
      '#default_value' => $this->get('ugl_url'),
      '#required' => false
    ];

    $form['ugl_parameters'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Request Parameters'),
      '#description' => $this->t('Define the parameters that will be in request.'),
      '#default_value' => $this->get('ugl_parameters'),
      '#required' => false,
    ];

    $form['ugl_errors'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Handling'),
      '#description' => $this->t('Define error messages for corresponding UGL error codes<br/>
          pattern: <strong>code|message|button|header</strong><br/>'),
      '#default_value' => $this->get('ugl_errors'),
      '#required' => false,
      '#translatable' => true
    ];

    $form['ugl_use_iframe'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('<b>Enable IFrame Launch</b>'),
      '#description' => $this->t("Enable game launch via IFrame on this Provider"),
      '#default_value' => $this->get('ugl_use_iframe'),
      '#translatable' => false,
      '#required' => false,
    ];

    $form['ugl_disable_iframe_subprovider'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Disable IFrame on the following Sub Providers'),
      '#description' => $this->t("One Sub Provider per line (Case Sensitive)"),
      '#default_value' => $this->get('ugl_disable_iframe_subprovider'),
      '#translatable' => false,
      '#required' => false,
    ];
  }
}
