<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Unsupported Currency Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_currency_form",
 *   route = {
 *     "title" = "Unsupported Currency Configuration",
 *     "path" = "/admin/config/webcomposer/games/unsupported-currency",
 *   },
 *   menu = {
 *     "title" = "Unsupported Currency Configuration",
 *     "description" = "Provides configuration for unsupported currency",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 10
 *   },
 * )
 */
class UnsupportedCurrencyConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Unsupported Currency Configuration definitions
   */
  /**
   * Unsupported Currency Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.unsupported_currency'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['unsupported_currency_configuration_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['unsupported_country_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Not supported country title'),
      '#description' => $this->t('Not allowed message title for country.'),
      '#default_value' => $this->get('unsupported_country_title'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['unsupported_currencies_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for currency.'),
      '#default_value' => $this->get('unsupported_currencies_message')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['unsupported_currencies_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported country LightBox Ok button'),
      '#default_value' => $this->get('unsupported_currencies_button'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['game_provider_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Game Provider Mapping for Unsupported Currency'),
      '#description' => $this->t('Game provider mapping. Pattern should be {game_provider_key}|{game provider name}'),
      '#default_value' => $this->get('game_provider_mapping'),
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }
}
