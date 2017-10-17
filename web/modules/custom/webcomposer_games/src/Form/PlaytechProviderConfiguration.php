<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Avaya chat configuration class
 */
class PlaytechProviderConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'playtech_provider_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_playtech_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.games_playtech_provider');

    $form['javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => t('Javascript Assets'),
      '#size' => 500,
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $config->get('javascript_assets')
    ];

    $form['playtech_pas_endpoint'] = [
      '#type' => 'textfield',
      '#title' => t('Playtech PAS Endpoint'),
      '#description' => $this->t('Defines the endpoint used for authenticating PAS'),
      '#default_value' => $config->get('playtech_pas_endpoint')
    ];

    $form['playtech_pas_casino'] = [
      '#type' => 'textfield',
      '#title' => t('Playtech PAS Casino'),
      '#description' => $this->t('Defines the casino value used for authenticating PAS'),
      '#default_value' => $config->get('playtech_pas_casino')
    ];

    $form['lobby_url'] = [
      '#type' => 'textfield',
      '#title' => t('Lobby URL'),
      '#description' => $this->t('The Playtech Lobby URL'),
      '#default_value' => $config->get('lobby_url')
    ];

    $form['languages'] = [
      '#type' => 'textarea',
      '#title' => t('Language Mapping'),
      '#size' => 500,
      '#description' => $this->t('Define the language mapping for Playtech games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $config->get('languages')
    ];

    $form['actions'] = ['#type' => 'actions'];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save')
    ];

    return $form;
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'javascript_assets',
      'playtech_pas_endpoint',
      'lobby_url',
      'playtech_pas_casino',
      'languages'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_playtech_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
