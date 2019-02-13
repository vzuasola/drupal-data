<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Twitch Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "twitch",
 *   route = {
 *     "title" = "Twitch",
 *     "path" = "/admin/config/owsports/twitch",
 *   },
 *   menu = {
 *     "title" = "Twitch",
 *     "description" = "Provides Twitch configuration",
 *     "parent" = "owsports_configs.list",
 *     "weight" = 30
 *   },
 * )
 */
class Twitch extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.twitch'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['twitch_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->sectionText($form);
    $this->sectionTwitch($form);

    return $form;
  }

  /**
   *
   */
  private function sectionText(array &$form) {
    $form['text_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Text Settings'),
      '#collapsible' => TRUE,
      '#group' => 'twitch_settings_tab',
    ];

    $form['text_config_group']['twitch_viewers'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Viewers Text'),
      '#description' => $this->t('Display text for x number of viewers.'),
      '#default_value' => $this->get('twitch_viewers'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['text_config_group']['twitch_disclaimer'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Disclaimer'),
      '#default_value' => $this->get('twitch_disclaimer'),
      '#translatable' => TRUE,
    );
  }

  /**
   *
   */
  private function sectionTwitch(array &$form) {
    $form['twitch_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('API Settings'),
      '#collapsible' => TRUE,
      '#group' => 'twitch_settings_tab',
    ];

    $form['twitch_config_group']['twitch_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitch URL'),
      '#description' => $this->t('Twitch API URL (with trailing slash).'),
      '#default_value' => $this->get('twitch_url'),
      '#required' => TRUE,
    ];

    $form['twitch_config_group']['twitch_player_js'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitch Player JS URL'),
      '#description' => $this->t('Twitch Player JS URL (with trailing slash).'),
      '#default_value' => $this->get('twitch_player_js'),
      '#required' => TRUE,
    ];

    $form['twitch_config_group']['twitch_client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#description' => $this->t('Client ID for request'),
      '#default_value' => $this->get('twitch_client_id'),
      '#required' => TRUE,
    ];
  }
}
