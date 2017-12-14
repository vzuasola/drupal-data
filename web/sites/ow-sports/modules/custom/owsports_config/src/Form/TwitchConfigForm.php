<?php

namespace Drupal\owsports_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class TwitchConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.twitch_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'owsports_config.twitch_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('owsports_config.twitch_configuration');

    $form['twitch_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['text_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Text Settings'),
      '#collapsible' => TRUE,
      '#group' => 'twitch_settings_tab',
    ];

    $form['twitch_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('API Settings'),
      '#collapsible' => TRUE,
      '#group' => 'twitch_settings_tab',
    ];

    $form['text_config_group']['twitch_viewers'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Viewers Text'),
      '#description' => $this->t('Display text for x number of viewers.'),
      '#default_value' => $config->get('twitch_viewers'),
      '#required' => TRUE,
    ];

    $form['text_config_group']['twitch_disclaimer'] = array(
        '#type' => 'textarea',
        '#title' => $this->t('Disclaimer'),
        '#default_value' => $config->get('twitch_disclaimer'),
    );

    $form['twitch_config_group']['twitch_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitch URL'),
      '#description' => $this->t('Twitch API URL (with trailing slash).'),
      '#default_value' => $config->get('twitch_url'),
      '#required' => TRUE,
    ];

    $form['twitch_config_group']['twitch_player_js'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitch Player JS URL'),
      '#description' => $this->t('Twitch Player JS URL (with trailing slash).'),
      '#default_value' => $config->get('twitch_player_js'),
      '#required' => TRUE,
    ];

    $form['twitch_config_group']['twitch_client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#description' => $this->t('Client ID for request'),
      '#default_value' => $config->get('twitch_client_id'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'twitch_url',
      'twitch_player_js',
      'twitch_client_id',
      'twitch_viewers',
      'twitch_disclaimer',
    ];

    foreach ($keys as $key) {
      $this->config('owsports_config.twitch_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
