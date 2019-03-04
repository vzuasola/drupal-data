<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Exchange Game Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "exchange_config_form",
 *   route = {
 *     "title" = "Exchange Game Configuration",
 *     "path" = "/admin/config/webcomposer/games/exchange",
 *   },
 *   menu = {
 *     "title" = "Exchange Game Configuration",
 *     "description" = "Provides configuration for Exchange Lottery Game",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 1
 *   },
 * )
 */
class ExchangeProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Exchange Game Configuration Providers definitions
   */
  /**
   * Exchange Game Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_exchange_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_exchange_provider_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Desktop Transaction  Domain'),
      '#default_value' => $this->get('transaction_subdomain'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['exchange_game_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Desktop URL Parameters'),
      '#description' => $this->t('Defines the Exchange URL Parameters'),
      '#default_value' => $this->get('exchange_game_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['exchange_tablet_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tablet Transaction Domain'),
      '#description' => $this->t('Defines the Exchange Tablet URL'),
      '#default_value' => $this->get('exchange_tablet_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['tablet_game_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Defines the exchange Tablet URL'),
      '#description' => $this->t('Defines the Tablet URL Parameters'),
      '#default_value' => $this->get('tablet_game_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for Exchange games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t('Define the supported curencies for Exchange.'),
      '#default_value' => $this->get('currency'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Countries'),
      '#description' => $this->t('Define the supported countries for Exchange.'),
      '#default_value' => $this->get('country'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

  }

}