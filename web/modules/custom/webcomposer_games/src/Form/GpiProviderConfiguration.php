<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * GPI Game Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "gpi_config_form",
 *   route = {
 *     "title" = "GPI Game Configuration",
 *     "path" = "/admin/config/webcomposer/games/gpi",
 *   },
 *   menu = {
 *     "title" = "GPI Game Configuration",
 *     "description" = "Provides Gpi Configuration Form",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 3
 *   },
 * )
 */
class GpiProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Gpi Game Providers definitions
   */
  /**
   * Gpi Game Providers definitions
   */
    const GPI_GAME_PROVIDERS = [
        'gpi_keno' => 'GPI Keno',
        'gpi_pk10' => 'GPI PK10',
        'gpi_thai_lottey' => 'GPI Thai Lottey',
        'gpi_live_dealer' => 'GPI Live Dealer',
        'gpi_ladder' => 'GPI Ladder'
    ];

  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_gpi_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['gpi_provider_settings_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    foreach (self::GPI_GAME_PROVIDERS as $key => $value) {
      $this->gpiContentTab($form[$key], $key, $value);
    }

    return $form;
  }

  private function generalConfig(&$form) {
    $form['gen_config'] = [
      '#type' => 'details',
      '#title' => $this->t('General Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'gpi_provider_settings_form'
    ];

    $form['gen_config']['gpi_game_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('GPI Game url'),
      '#description' => $this->t('Defines the GPI Game Url'),
      '#default_value' => $this->get('gpi_game_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['gpi_lottery_keno_version_no'] = [
      '#type' => 'textfield',
      '#title' => $this->t('GPI Lottery Keno Version Number'),
      '#description' => $this->t('Defines the  GPI lottery Keno Version Number'),
      '#default_value' => $this->get('gpi_lottery_keno_version_no'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['gpi_vendor_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('GPI  Vendor Id'),
      '#description' => $this->t('Defines the  GPI  Vendor Id'),
      '#default_value' => $this->get('gpi_vendor_id'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

  }

  private function gpiContentTab(&$form, $key, $value) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'gpi_provider_settings_form'
    ];

    $form[$key . '_currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t("Currency mapping for " . $value),
      '#default_value' => $this->get($key . '_currency'),
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

    $form[$key . '_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country'),
      '#description' => $this->t("Define the Unsupported Country code for " . $value),
      '#default_value' => $this->get($key . '_country'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_extra_params'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Extra Parameters'),
      '#description' => $this->t("Defines extra parameters that will be added to the game url"),
      '#default_value' => $this->get($key . '_extra_params'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

  }

}