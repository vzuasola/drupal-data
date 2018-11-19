<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Playtech Provider Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "icore_playtech_provider_form",
 *   route = {
 *     "title" = "ICore Playtech Provider Configuration",
 *     "path" = "/admin/config/webcomposer/games/icore/playtech",
 *   },
 *   menu = {
 *     "title" = "ICore Playtech Provider Configuration",
 *     "description" = "Provides configuration for Playtech game provider",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 6
 *   },
 * )
 */
class ICorePlaytechProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * ICore Playtech Provider Configuration
   */
  /**
   * ICore Playtech Provider Configuration
   */
    const PLAYTECH_CASINO = [
        'dafabetgames' => 'dafabetgames'
    ];

  protected function getEditableConfigNames() {
    return ['webcomposer_config.icore_playtech_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['icore_playtech_provider_form'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    foreach (self::PLAYTECH_CASINO as $key => $value) {
      $this->gpiContentTab($form[$key], $key, $value);
    }

    return $form;
  }

  private function gpiContentTab(&$form, $key, $value) {
    $form = array(
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'icore_playtech_provider_form'
    );

    $form[$key . '_currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t("Currency mapping for " . $value),
      '#default_value' => $this->get($key . '_currency'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unsupported Countries'),
      '#description' => $this->t("Define the unsupported countries for " . $value),
      '#default_value' => $this->get($key . '_country'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t("Language mapping for " . $value),
      '#default_value' => $this->get($key . '_language_mapping'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_iapiconf_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iapiConf Override'),
      '#description' => $this->t("iapiConf override for ".$value." <br/>
        <b>format:</b> sitelang|icore language key</br>
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
      '#default_value' => $this->get($key . '_iapiconf_override'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

  }

}