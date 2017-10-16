<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Games configuration class
 */
class ICoreGamesIntegrationConfiguration extends ConfigFormBase {

  /**
   * ICore Game Providers definition
   */
    const ICORE_GAME_PROVIDERS = [
        'fish_hunter' => 'Fish Hunter',
    ];

  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'icore_games_integration_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.icore_games_integration'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.icore_games_integration');

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('ICore Games Integration'),
    );

    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $form[$key] = array(
        '#type' => 'details',
        '#title' => t($value),
        '#group' => 'advanced',
      );
      $form[$key]["{$key}_currency"] = array(
        '#type' => 'textarea',
        '#title' => t('Supported Currencies'),
        '#description' => $this->t("Currency mapping for {$value}."),
        '#default_value' => $config->get("{$key}_currency")
      );
    }

    $form['message'] = array(
      '#type' => 'details',
      '#title' => t('Default Message'),
      '#group' => 'advanced',
    );

    $form['message']['unsupported_currencies_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Not supported currency title'),
      '#description' => $this->t('Not allowed message title for currency.'),
      '#default_value' => $config->get('unsupported_currencies_title')
    );

    $config_message = $config->get('unsupported_currencies_message');
    $form['message']['unsupported_currencies_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for currency.'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    );

    $form['message']['unsupported_currencies_button'] = array(
      '#type' => 'textfield',
      '#title' => t('Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox Ok button'),
      '#default_value' => $config->get('unsupported_currencies_button')
    );

    $form['message']['fallback_error'] = array(
      '#type' => 'textfield',
      '#title' => t('Fallback error'),
      '#description' => $this->t('Fallback error.'),
      '#default_value' => $config->get('fallback_error')
    );

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
    $providers = [];
    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $providers[] = "{$key}_currency";
    }

    $keys = [
      'unsupported_currencies_title',
      'unsupported_currencies_message',
      'unsupported_currencies_button',
      'fallback_error'
    ];

    $newKeys = array_merge($providers, $keys);

    foreach ($newKeys as $key) {
      $this->config('webcomposer_config.icore_games_integration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
