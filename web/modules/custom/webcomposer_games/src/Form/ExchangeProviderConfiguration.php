<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Exchange configuration class
 */
class ExchangeProviderConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */

  public function getFormId() {
    return 'exchange_provider_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_exchange_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.games_exchange_provider');

    $form['transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Desktop Transaction  Domain'),
      '#default_value' => $config->get('transaction_subdomain'),
    ];

    $form['exchange_game_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Desktop Url Parameters'),
      '#description' => $this->t('Defines the exchange Url Parameters'),
      '#default_value' => $config->get('exchange_game_url')
    );

    $form['exchange_tablet_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Tablet Transaction  Domain'),
      '#description' => $this->t('Defines the exchange Tablet Url Parameters'),
      '#default_value' => $config->get('exchange_tablet_url')
    );

    $form['tablet_game_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Tablet Url Parameters'),
      '#maxlength' => 300,
      '#size' => 300,
      '#description' => $this->t('Defines the Tablet Url Parameters'),
      '#default_value' => $config->get('tablet_game_url')
    );

    $form['languages'] = array(
      '#type' => 'textarea',
      '#title' => t('Language Mapping'),
      '#size' => 500,
      '#description' => $this->t('Define the language mapping for Exchange games. Pipe separated language code and value, one per line.
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

   $form['country'] = array(
      '#type' => 'textarea',
      '#title' => t('Country'),
      '#size' => 500,
      '#description' => $this->t('Define the Country for Exchange games.
         '),
      '#default_value' => $config->get('country')
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
      'exchange_game_url',
      'exchange_tablet_url',
      'tablet_game_url',
      'languages','currency','country',
      'transaction_subdomain',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.games_exchange_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}