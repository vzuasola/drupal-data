<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * GoldenRace chat configuration class
 */
class GoldenRaceProviderConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'goldenrace_provider_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_goldenrace_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.games_goldenrace_provider');

    $form['javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => t('Javascript Assets'),
      '#size' => 500,
      '#description' => $this->t('Define the GlobalBet scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $config->get('javascript_assets')
    ];

    $form['languages'] = [
      '#type' => 'textarea',
      '#title' => t('Language Mapping'),
      '#size' => 500,
      '#description' => $this->t('Define the language mapping for Goldenrace games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $config->get('languages')
    ];
    $form["country"] = [
        '#type' => 'textarea',
        '#title' => t('Country'),
        '#size' => 500,
        '#description' => $this->t('Define the Unsupported Country code for Golden race Lottery games.
           '),
        '#default_value' => $config->get("country")
       ];

    $form['currency'] = array(
      '#type' => 'textarea',
      '#title' => t('Currency'),
      '#size' => 500,
      '#description' => $this->t('Define the curency for goldenrace games.
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
      'javascript_assets',
      'languages',
      'currency'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_goldenrace_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
