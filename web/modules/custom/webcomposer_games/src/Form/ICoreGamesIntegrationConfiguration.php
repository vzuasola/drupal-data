<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * ICore Games configuration class
 */
class ICoreGamesIntegrationConfiguration extends ConfigFormBase {

  /**
   * ICore Game Providers definitions
   */
    const ICORE_GAME_PROVIDERS = [
        'asia_gaming' => 'Asia Gaming',
        'kiron_virtual_sports' => 'Virtual Sports',
        'gb_virtual_sports' => 'Global Bet Virtual Sports',
        'skywind' => 'Skywind',
        'voidbridge' => 'Voidbridge',
        'gold_deluxe' => 'Gold Deluxe',
        'video_racing' => 'Video Racing',
        'sa_gaming' => 'SA Gaming',
        'allbet' => 'AllBet',
        'tgp' => 'TGP',
        'evo_gaming' => 'Evolution Gaming',
        'ebet' => 'eBet',
        'cq9' => 'CQ9',
        'solid_gaming' => 'Solid Gaming',
        'gameworx' => 'Gameworx'
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

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('ICore Games Integration'),
    ];

    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $form[$key] = [
        '#type' => 'details',
        '#title' => t($value),
        '#group' => 'advanced',
      ];
      $form[$key]["{$key}_currency"] = [
        '#type' => 'textarea',
        '#title' => t('Supported Currencies'),
        '#description' => $this->t("Currency mapping for {$value}."),
        '#default_value' => $config->get("{$key}_currency")
      ];
      $form[$key]["{$key}_language_mapping"] = [
        '#type' => 'textarea',
        '#title' => t('Language Mapping'),
        '#description' => $this->t("Language mapping for {$value}."),
        '#default_value' => $config->get("{$key}_language_mapping")
      ];
    }

    $form['message'] = [
      '#type' => 'details',
      '#title' => t('Unsupported Currency Message'),
      '#group' => 'advanced',
    ];

    $newUCLFormUrl = Url::fromRoute('webcomposer_games.unsupported_currency_configuration_form');
    $newUCLFormLink = \Drupal::l(t('here'), $newUCLFormUrl);

    $form['message']['deprecated'] = [
      '#type' => 'details',
      '#title' => $this->t('Deprecated'),
      '#description' => $this->t(
        'These are deprecated fields for unsupported currencies.
        Please click @link to access the new form.', array('@link' => $newUCLFormLink)
      ),
      '#collapsible' => TRUE,
      '#open' => FALSE
    ];

    $form['message']['deprecated']['unsupported_currencies_title'] = [
      '#type' => 'textfield',
      '#title' => t('Not supported currency title'),
      '#description' => $this->t('Not allowed message title for currency.'),
      '#default_value' => $config->get('unsupported_currencies_title')
    ];

    $config_message = $config->get('unsupported_currencies_message');
    $form['message']['deprecated']['unsupported_currencies_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for currency.'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    ];

    $form['message']['deprecated']['unsupported_currencies_button'] = [
      '#type' => 'textfield',
      '#title' => t('Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox Ok button'),
      '#default_value' => $config->get('unsupported_currencies_button')
    ];

    $form['message']['deprecated']['game_provider_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Game Provider Mapping for Unsupported Currency'),
      '#description' => $this->t('Game provider mapping. Pattern should be {game_provider_key}|{game provider name}'),
      '#default_value' => $config->get('game_provider_mapping')
    ];

    $form['message']['fallback_error_title'] = [
      '#type' => 'textfield',
      '#title' => t('Fallback Error Title'),
      '#description' => $this->t('Fallback error Title.'),
      '#default_value' => $config->get('fallback_error_title')
    ];

    $config_message = $config->get('fallback_error_message');
    $form['message']['fallback_error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Fallback Error Message'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    ];

    $form['message']['fallback_error_button'] = [
      '#type' => 'textfield',
      '#title' => t('Fallback error button'),
      '#description' => $this->t('Fallback Error LightBox Ok button'),
      '#default_value' => $config->get('fallback_error_button')
    ];

    $form['safari_notif'] = [
      '#type' => 'details',
      '#title' => t('Safari Notification Message'),
      '#group' => 'advanced',
    ];

    $config_safari = $config->get('safari_notif_message');
    $form['safari_notif']['safari_notif_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Safari Notification Message.'),
      '#default_value' => $config_safari['value'],
      '#format' => $config_safari['format'],
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
    $providers = [];
    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $providers[] = "{$key}_currency";
      $providers[] = "{$key}_language_mapping";
    }

    $keys = [
      'unsupported_currencies_title',
      'unsupported_currencies_message',
      'unsupported_currencies_button',
      'game_provider_mapping',
      'fallback_error_title',
      'fallback_error_message',
      'fallback_error_button',
      'safari_notif_message',
    ];

    $result = array_merge($providers, $keys);

    foreach ($result as $key) {
      $this->config('webcomposer_config.icore_games_integration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
