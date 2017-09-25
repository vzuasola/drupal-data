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
    return ['casino_config.games_configuration'];
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
    $config = $this->config('casino_config.games_configuration');

    $form['games_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['thumbnail_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Thumbnail'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['thumbnail_group']['play_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $config->get('play_text'),
      '#required' => TRUE,
    );

    $form['thumbnail_group']['play_for_fun_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play For Fun Link Text'),
      '#description' => $this->t('The text to display on play for fun link.'),
      '#default_value' => $config->get('play_for_fun_text'),
      '#required' => TRUE,
    );

    $form['thumbnail_group']['game_info_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $config->get('game_info_text'),
      '#required' => TRUE,
    );

    $form['category_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Category'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['category_group']['kebab_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Category Kebab Text'),
      '#description' => $this->t('The text to display on category kebab menu.'),
      '#default_value' => $config->get('kebab_menu_text'),
      '#required' => TRUE,
    );

    $form['category_group']['load_more_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Load More Text'),
      '#description' => $this->t('The text to display on load more button.'),
      '#default_value' => $config->get('load_more_text'),
      '#required' => TRUE,
    );

    $form['category_group']['load_more_disabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Load More'),
      '#description' => $this->t('If checked all games will be shown at once.'),
      '#default_value' => $config->get('load_more_disabled'),
      '#required' => FALSE,
    );

    $form['header_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Header Section'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );

    $form['header_group']['disable_language_selector'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Language Selector'),
      '#default_value' => $config->get('disable_language_selector')
    );

    $form['header_group']['disable_announcement_icon'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Announcement Icon'),
      '#default_value' => $config->get('disable_announcement_icon')
    );

    $form['game_page_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Game Page'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );

    $form['game_page_group']['freeplay_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Free Play Lightbox Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $config->get('freeplay_lightbox_title'),
      '#required' => TRUE,
    );

    $freePlayLightboxContent = $config->get('freeplay_lightbox_content');
    $form['game_page_group']['freeplay_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Free Play Lightbox Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $freePlayLightboxContent['value'],
      '#format' => $freePlayLightboxContent['format'],
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
      'kebab_menu_text',
      'load_more_text',
      'load_more_disabled',
      'freeplay_lightbox_title',
      'freeplay_lightbox_content',
      'disable_language_selector',
      'disable_announcement_icon'
    );

    foreach ($keys as $key) {
      $this->config('casino_config.games_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
