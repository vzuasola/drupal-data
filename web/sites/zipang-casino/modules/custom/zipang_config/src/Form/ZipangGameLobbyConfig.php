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
    $this->sectionGameSearch($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['page_setting'] = [
      '#type' => 'details',
      '#title' => t('Game Lobby Quicklinks'),
      '#group' => 'advanced',
    ];

    $form['page_setting']['quicklinks_title'] = [
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
  }
}
