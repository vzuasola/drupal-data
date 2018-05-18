<?php

namespace Drupal\games_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesConfigurationForm extends ConfigFormBase {
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
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('games_config.games_configuration');

    $form['games_configuration_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];
    $this->gamsThumbnailSection($form, $config);
    $this->gamePageLightboxSection($form, $config);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $keys = [
      'play_text',
      'game_info_text',
      'pas_error_lightbox_title',
      'pas_error_lightbox_content',
    ];

    foreach ($keys as $key) {
      $this->config('games_config.games_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

  private function gamsThumbnailSection(&$form, $config) {
    $form['thumbnail_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Thumbnail Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    ];

    $form['thumbnail_group']['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $config->get('play_text'),
      '#required' => TRUE,
    ];

    $form['thumbnail_group']['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $config->get('game_info_text'),
      '#required' => TRUE,
    ];
  }

  private function gamePageLightboxSection(&$form, $config) {
    $form['lightbox_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Game Page Lightbox'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );
    $pasLightboxGroupTitle = $this->t('PAS Error (Lightbox)');
    $form['lightbox_group']['pas'] = array(
        '#type' => 'details',
        '#title' => $pasLightboxGroupTitle,
        '#open' => TRUE,
        '#description' => '<p>This lightbox will appear if pas authentication failed on game launch.</p>'
    );
    $form['lightbox_group']['pas']['pas_error_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $config->get('pas_error_lightbox_title'),
      '#required' => FALSE,
    );
    $pasErrorLightboxContent = $config->get('pas_error_lightbox_content');
    $form['lightbox_group']['pas']['pas_error_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $pasErrorLightboxContent['value'],
      '#format' => $pasErrorLightboxContent['format'],
      '#required' => TRUE,
    );
  }
}
