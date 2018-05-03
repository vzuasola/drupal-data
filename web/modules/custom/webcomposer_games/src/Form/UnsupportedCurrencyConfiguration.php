<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Games configuration class
 */
class UnsupportedCurrencyConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'unsupported_currency_configuration_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.unsupported_currency'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.unsupported_currency');

    $form['unsupported_currencies_title'] = [
      '#type' => 'textfield',
      '#title' => t('Not supported currency title'),
      '#description' => $this->t('Not allowed message title for currency.'),
      '#default_value' => $config->get('unsupported_currencies_title')
    ];

    $config_message = $config->get('unsupported_currencies_message');
    $form['unsupported_currencies_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for currency.'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    ];

    $form['unsupported_currencies_button'] = [
      '#type' => 'textfield',
      '#title' => t('Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox Ok button'),
      '#default_value' => $config->get('unsupported_currencies_button')
    ];

    $form['game_provider_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Game Provider Mapping for Unsupported Currency'),
      '#description' => $this->t('Game provider mapping. Pattern should be {game_provider_key}|{game provider name}'),
      '#default_value' => $config->get('game_provider_mapping')
    ];

    return parent::buildForm($form, $form_state);
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
      'unsupported_currencies_title',
      'unsupported_currencies_message',
      'unsupported_currencies_button',
      'game_provider_mapping',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.unsupported_currency')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
