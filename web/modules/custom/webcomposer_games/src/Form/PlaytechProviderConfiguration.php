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

    $form['javascript_assets'] = array(
      '#type' => 'textarea',
      '#title' => t('Javascript Assets'),
      '#size' => 500,
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $config->get('javascript_assets')
    );

    $form['playtech_pas_endpoint'] = array(
      '#type' => 'textfield',
      '#title' => t('Playtech PAS Endpoint'),
      '#description' => $this->t('Defines the endpoint used for authenticating PAS'),
      '#default_value' => $config->get('playtech_pas_endpoint')
    );

    $form['lobby_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Lobby URL'),
      '#description' => $this->t('The Playtech Lobby URL'),
      '#default_value' => $config->get('lobby_url')
    );

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
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_playtech_provider')->set($key, $form_state->getValue($key))->save();
    }
  }
}
