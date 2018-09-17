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
      'gameworx_lottery' => 'Gameworx Lottery games',
      'gameworx_quicklotto' => 'Gameworx Quick Lotto',
      'betconstruct' => 'BetConstruct'
    ];

    const ICORE_GAME_GX_PROVIDERS = [
      'gameworx_lottery' => 'Gameworx Lottery games',
      'gameworx_quicklotto' => 'Gameworx Quick Lotto'
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
      $form[$key]["{$key}_country"] = [
        '#type' => 'textarea',
        '#title' => t('Country'),
        '#size' => 500,
        '#description' => $this->t("Define the Unsupported Country code for {$value} games.
           "),
        '#default_value' => $config->get("{$key}_country")
       ];
    }

    foreach (self::ICORE_GAME_GX_PROVIDERS as $key => $value) {
      $form[$key]["{$key}_lobby_type"] = [
        '#type' => 'textfield',
        '#title' => t('LobbyType'),
        '#description' => $this->t("Please enter lobby type."),
        '#default_value' => $config->get("{$key}_lobby_type")
      ];

      $form[$key]["{$key}_operator_id"] = [
        '#type' => 'textfield',
        '#title' => t('Operator ID'),
        '#description' => $this->t("Please enter Operator ID."),
        '#default_value' => $config->get("{$key}_operator_id")
      ];

      $form[$key]["{$key}_plugin_id"] = [
        '#type' => 'textfield',
        '#title' => t('Plugin ID'),
        '#description' => $this->t("Please enter plugin ID."),
        '#default_value' => $config->get("{$key}_plugin_id")
      ];

      $form[$key]["{$key}_realitycheck_url"] = [
        '#type' => 'textfield',
        '#title' => t('Reality Check URL'),
        '#description' => $this->t("Please enter Reality CheckUrl."),
        '#default_value' => $config->get("{$key}_realitycheck_url")
      ];

      $form[$key]["{$key}_deposit_url"] = [
        '#type' => 'textfield',
        '#title' => t('Deposit URL'),
        '#description' => $this->t("Please enter Deposit Url."),
        '#default_value' => $config->get("{$key}_deposit_url")
      ];

      $form[$key]["{$key}_exit_url"] = [
        '#type' => 'textfield',
        '#title' => t('Exit URL'),
        '#description' => $this->t("Please enter Exit Url."),
        '#default_value' => $config->get("{$key}_exit_url")
      ];
      
    }

    /**
     * Custom parameter specific to BetConstruct
     */
    $form['betconstruct']["betconstruct_container_id"] = [
      '#type' => 'textfield',
      '#title' => t('Container ID'),
      '#description' => $this->t("The ID of html element where BetConstruct will be inserted"),
      '#default_value' => $config->get("betconstruct_container_id")
    ];

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
      $providers[] = "{$key}_country";
    }

    foreach (self::ICORE_GAME_GX_PROVIDERS as $key => $value) {
      $providers[] = "{$key}_exit_url";
      $providers[] = "{$key}_deposit_url";
      $providers[] = "{$key}_realitycheck_url";
      $providers[] = "{$key}_plugin_id";
      $providers[] = "{$key}_operator_id";
      $providers[] = "{$key}_lobby_type";
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
      'betconstruct_container_id',
    ];

    $result = array_merge($providers, $keys);

    foreach ($result as $key) {
      $this->config('webcomposer_config.icore_games_integration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
