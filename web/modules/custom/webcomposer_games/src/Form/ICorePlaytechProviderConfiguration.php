<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Games configuration class
 */
class ICorePlaytechProviderConfiguration extends ConfigFormBase {

  /**
   * iapiConf casino
   *
   * Made this as an array so "future" icore playtech games that will be migrated can just add the casino
   */
    const PLAYTECH_CASINO = [
        'dafabetgames' => 'dafabetgames'
    ];

  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'icore_playtech_provider_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.icore_playtech_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.icore_playtech_provider');

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('ICore Playtech Provider'),
    );

    foreach (self::PLAYTECH_CASINO as $key => $value) {
      $form[$key] = array(
        '#type' => 'details',
        '#title' => t($value),
        '#group' => 'advanced',
      );
      $form[$key]["{$key}_currency"] = array(
        '#type' => 'textarea',
        '#title' => t('Supported Currencies'),
        '#description' => $this->t("Currency mapping for {$value}."),
        '#default_value' => $config->get("{$key}_currency")
      );
      $form[$key]["{$key}_language_mapping"] = array(
        '#type' => 'textarea',
        '#title' => t('Language Mapping'),
        '#default_value' => $config->get("{$key}_language_mapping"),
        '#description' => $this->t("Language mapping for {$value}.<br/>
          <b>format:</b> sitelang|icore language key<br/>
        ")
      );
      $form[$key]["{$key}_iapiconf_override"] = array(
        '#type' => 'textarea',
        '#title' => t('iapiConf Override'),
        '#description' => $this->t("iapiConf override for {$value} <br/>
          <b>format:</b> key|value</br>
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
        '#default_value' => $config->get("{$key}_iapiconf_override"),
        '#rows' => 10
      );
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $providers = [];
    foreach (self::PLAYTECH_CASINO as $key => $value) {
      $providers[] = "{$key}_currency";
      $providers[] = "{$key}_language_mapping";
      $providers[] = "{$key}_iapiconf_override";
    }

    foreach ($providers as $key) {
      $this->config('webcomposer_config.icore_playtech_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
