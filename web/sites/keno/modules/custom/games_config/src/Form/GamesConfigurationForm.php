<?php

namespace Drupal\games_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games Page Loading form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_config_button",
 *   route = {
 *     "title" = "Games Configuration",
 *     "path" = "/admin/config/games/button",
 *   },
 *   menu = {
 *     "title" = "Games Custom Configuration",
 *     "description" = "Configure the Games Button",
 *     "parent" = "games_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class GamesConfigurationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.games_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'games_config.games_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $this->get('play_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $this->get('game_info_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['free_play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Free Play Text'),
      '#description' => $this->t('The text to display on Free Play Link.'),
      '#default_value' => $this->get('free_play_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    return $form;
  }

}
