<?php

namespace Drupal\casino_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'casino_games.games_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.games_configuration');

    $form['play_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $config->get('play_text'),
      '#required' => TRUE,
    );

    $form['play_for_fun_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play For Fun Link Text'),
      '#description' => $this->t('The text to display on play for fun link.'),
      '#default_value' => $config->get('play_for_fun_text'),
      '#required' => TRUE,
    );

    $form['game_info_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $config->get('game_info_text'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    
    $keys = array(
      'play_text',
      'play_for_fun_text',
      'game_info_text',
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
