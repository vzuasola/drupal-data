<?php

namespace Drupal\webcomposer_playtech_integration\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;

/**
 * Playtech Integration configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "playtech_integration_configuration_form",
 *   route = {
 *     "title" = "Playtech Integration Configuration",
 *     "path" = "/admin/config/webcomposer/playtech-integration/config",
 *   },
 *   menu = {
 *     "title" = "Playtech Integration Configuration",
 *     "description" = "Provides configuration for playtech integration",
 *     "parent" = "webcomposer_playtech_integration.list",
 *   },
 * )
 */
class GTSForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_playtech_integration.wpi_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Playtech Integration Configuration'),
    ];

    $this->buildPlaytechForm($form);
    return $form;
  }

  private function buildPlaytechForm(&$form) {
    $form['general_config']['module_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Toggle Playtech Integraton Module'),
      '#description' => $this->t('Enabling this will override the legacy way for playtech integration'),
      '#default_value' => $this->get('module_toggle')
    ];

    $form['general_config']['playtech_providers'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Playtech Providers'),
      '#description' => $this->t('Define playtech providers'),
      '#default_value' => $this->get('playtech_providers'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $casinos = array_map('trim', explode(PHP_EOL, $this->get('playtech_providers')));

    foreach ($casinos as $casino) {
      if (!empty($casino)) {
        $this->contentTab($form[$casino], $casino);
      }
    }

  }

  private function contentTab(&$form, $value) {
    $form = array(
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'playtech_integration_form'
    );

    $this->integrationConfig($form['integration_config'], $value);
    $this->errorConfig($form['error_handling_config'], $value);
  }

  private function integrationConfig(&$form, $value)
  {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Integration Settings'),
      '#collapsible' => true,
      '#group' => 'games_playtech_integration_form',
      '#access' => !$this->isTranslated() // Hide the integration config since all fields are non translatable
    ];

    $form[$value. '_javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get($value. '_javascript_assets'),
      '#required' => false,
    ];

    $form[$value. '_playtech_pas_casino'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech PAS Casino'),
      '#description' => $this->t('Defines the casino value used for authenticating PAS'),
      '#default_value' => $this->get($value.'_playtech_pas_casino'),
      '#required' => false
    ];

    $form[$value . '_currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t("Currency mapping for " . $value),
      '#default_value' => $this->get($value . '_currency'),
      '#required' => false,
    ];

    $form[$value . '_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unsupported Countries'),
      '#description' => $this->t("Define the unsupported countries for " . $value),
      '#default_value' => $this->get($value . '_country'),
      '#required' => false,
    ];

    $form[$value . '_language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t("Language mapping for " . $value),
      '#default_value' => $this->get($value . '_language_mapping'),
      '#required' => false,
    ];

    $form[$value . '_iapiconf_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iapiConf Override'),
      '#description' => $this->t("iapiConf override for ".$value." <br/>
        <b>format:</b> sitelang|icore language value</br>
        <b>Keys available:</b><br/>
         - casinoname<br/>
         - loginServer<br/>
         - clientSkin<br/>
         - clientType<br/>
         - clientPlatform<br/>
         - clientVersion<br/>
         - systemId<br/>
         - serviceType<br/>
         - loginDomainRetryCount<br/>
         - loginDomainRequestTimeout<br/>
         - loginDomainRetryInterval<br/>
         - fingerprintEnabled<br/>
         - onlypostrequestsforlogout<br/>
         - useIframeForGetLoggedInPlayer<br/>
         - clientUrl_casino<br/>
      "),
      '#default_value' => $this->get($value . '_iapiconf_override'),
      '#required' => false,
    ];
  }

  private function errorConfig(&$form, $value) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Error Handling'),
      '#collapsible' => TRUE,
      '#group' => 'games_playtech_integration_form'
    ];

    $form[$value. '_error_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Mapping'),
      '#description' => $this->t('Define error messages for corresponding PAS error codes<br/>
          pattern: <strong>code|message|custom_header_title</strong><br/>
          special codes: <br/>
           - <i>all</i>: Generic handler'),
      '#default_value' => $this->get($value.'_error_mapping'),
      '#rows' => 10,
      '#translatable' => true
    ];

    $form[$value. '_error_header_title_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header title text'),
      '#description' => $this->t('Default header title for the error.'),
      '#default_value' => $this->get($value.'_error_header_title_text'),
      '#translatable' => true
    ];

    $form[$value. '_error_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button text'),
      '#description' => $this->t('Button Text and link.
      <br/>Sample value: Ok|www.dafabet.com
      <br/>Empty 2nd part of | or |#close will close the lightbox.
      <br/>"|#reload" will reload the current page.
      <br/>Leave empty for no button'),
      '#default_value' => $this->get($value.'_error_button'),
      '#translatable' => true
    ];
  }
}
