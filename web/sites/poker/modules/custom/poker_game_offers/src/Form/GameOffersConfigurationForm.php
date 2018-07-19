<?php
namespace Drupal\poker_game_offers\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "poker_game_offers",
 *   route = {
 *     "title" = "Game Offers Configuration",
 *     "path" = "/admin/game-offers/config",
 *   },
 *   menu = {
 *     "title" = "Game Offers Configuration",
 *     "description" = "Provides configuration for game offers page.",
 *     "parent" = "poker_game_offers.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class GameOffersConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['poker_config.game_offers'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
      '#required' => TRUE
    ];

    $this->casinoGames($form);
    $this->pokerGames($form);

    return $form;
  }

  private function casinoGames(&$form) {
    $form['casino'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Game Offers'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['casino']['casino_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $this->get('casino_label'),
      '#translatable' => TRUE,
      '#required' => TRUE
    ];
  }

  private function pokerGames(&$form) {
    $form['poker'] = [
      '#type' => 'details',
      '#title' => $this->t('Poker Game Offers'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['poker']['poker_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $this->get('poker_label'),
      '#translatable' => TRUE,
      '#required' => TRUE
    ];
  }
}
