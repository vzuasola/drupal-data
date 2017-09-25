<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Opus Game configuration class
 */
class OpusProviderConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'opus_provider_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_opus_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.games_opus_provider');

    $content = $config->get('opus_game_loader_content');
    $form['opus_game_loader_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Game Loader Content'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
    ];

    $form['opus_game_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Opus Game url'),
      '#description' => $this->t('Defines the Game Url'),
      '#default_value' => $config->get('opus_game_url')
    );

    $form['opus_alternative_game_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Opus Alternate Game url'),
      '#description' => $this->t('Defines the alternate game url'),
      '#default_value' => $config->get('opus_alternative_game_url')
    );

    $form['languages'] = array(
      '#type' => 'textarea',
      '#title' => t('Language Mapping'),
      '#size' => 500,
      '#description' => $this->t('Define the language mapping for Playtech games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $config->get('languages')
    );
    
   $form['currency'] = array(
      '#type' => 'textarea',
      '#title' => t('Currency'),
      '#size' => 500,
      '#description' => $this->t('Define the curency for opus games.
         '),
      '#default_value' => $config->get('currency')
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
      'opus_game_loader_content',
      'opus_game_url',
      'opus_alternative_game_url',
      'languages','currency'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_opus_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
