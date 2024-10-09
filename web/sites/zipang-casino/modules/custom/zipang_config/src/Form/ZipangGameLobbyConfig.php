<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_game_lobby",
 *   route = {
 *     "title" = "Zipang Game Lobby Configuration",
 *     "path" = "/admin/config/zipang/game_lobby_configuration",
 *   },
 *   menu = {
 *     "title" = "Zipang Game Lobby Configuration",
 *     "description" = "Provides Zipang Game Lobby page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangGameLobbyConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.game_lobby_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Game Lobby Config'),
    ];

    $this->sectionPageSetting($form);
    $this->sectionGameQuicklinks($form);
    $this->sectionGameSearch($form);
    $this->sectionGameDetails($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */

  private function sectionPageSetting(array &$form) {
    $form['page_setting'] = [
      '#type' => 'details',
      '#title' => t('Game Lobby Config'),
      '#group' => 'advanced',
    ];

    $form['page_setting']['enable_lobby'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Game Lobby',
      '#default_value' => $this->get('enable_lobby'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['show_all'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show All Game Category'),
      '#default_value' => $this->get('show_all'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionGameQuicklinks(array &$form) {
    $form['game_quicklinks'] = [
      '#type' => 'details',
      '#title' => t('Game Lobby Quicklinks'),
      '#group' => 'advanced',
    ];

    $form['game_quicklinks']['quicklinks_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Quicklinks Title'),
      '#default_value' => $this->get('quicklinks_title'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionGameSearch(array &$form) {
    $form['game_search'] = [
      '#type' => 'details',
      '#title' => t('Game Search Config'),
      '#group' => 'advanced',
    ];

    $form['game_search']['games_not_matched'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Title Not Matched'),
      '#default_value' => $this->get('games_not_matched'),
      '#translatable' => TRUE,
    ];

    $form['game_search']['top_search_result'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Top Search Result'),
      '#default_value' => $this->get('top_search_result'),
      '#translatable' => TRUE,
    ];

    $form['game_search']['default_category'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Category'),
      '#default_value' => $this->get('default_category'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionGameDetails(array &$form) {
    $form['game_details'] = [
      '#type' => 'details',
      '#title' => t('Game Details Config'),
      '#group' => 'advanced',
    ];

    $form['game_details']['play_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Label'),
      '#default_value' => $this->get('play_button_label'),
      '#translatable' => TRUE,
    ];

    $form['game_details']['rtp_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('RTP Label'),
      '#default_value' => $this->get('rtp_label'),
      '#translatable' => TRUE,
    ];

    $form['game_details']['bet_range_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Bet Range Label'),
      '#default_value' => $this->get('bet_range_label'),
      '#translatable' => TRUE,
    ];
  }
}
