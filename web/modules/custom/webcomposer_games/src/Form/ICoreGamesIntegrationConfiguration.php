<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Games Integration Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_games",
 *   route = {
 *     "title" = "ICore Games Integration Configuration",
 *     "path" = "/admin/config/webcomposer/games/icore",
 *   },
 *   menu = {
 *     "title" = "ICore Games Integration Configuration",
 *     "description" = "Provides configuration for icore games integration",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 30
 *   },
 * )
 */

class ICoreGamesIntegrationConfiguration extends FormBase {

    /**
     * ICore Game Providers definitions
     */
    const ICORE_GAME_PROVIDERS = [
        'fish_hunter' => 'Fish Hunter',
        'kiron_virtual_sports' => 'Virtual Sports',
        'skywind' => 'Skywind',
        'voidbridge' => 'Voidbridge',
        'gold_deluxe' => 'Gold Deluxe',
        'video_racing' => 'Video Racing',
        'sa_gaming' => 'SA Gaming',
    ];

    /**
     * @inheritdoc
     */
    protected function getEditableConfigNames() {
        return ['webcomposer_config.icore_games_integration'];
    }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.icore_games_integration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('ICore Games Integration'),
    ];

    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $form[$key] = [
        '#type' => 'details',
        '#title' => $this->t($value),
        '#group' => 'advanced',
      ];
      $form[$key]["{$key}_currency"] = [
        '#type' => 'textarea',
        '#title' => $this->t('Supported Currencies'),
        '#description' => $this->t("Currency mapping for {$value}."),
        '#default_value' => $config->get("{$key}_currency")
      ];
      $form[$key]["{$key}_language_mapping"] = [
        '#type' => 'textarea',
        '#title' => $this->t('Language Mapping'),
        '#description' => $this->t("Language mapping for {$value}."),
        '#default_value' => $config->get("{$key}_language_mapping")
      ];
    }

    $form['message'] = [
      '#type' => 'details',
      '#title' => $this->t('Unsupported Currency Message'),
      '#group' => 'advanced',
    ];

    $form['message']['unsupported_currencies_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Not supported currency title'),
      '#description' => $this->t('Not allowed message title for currency.'),
      '#default_value' => $config->get('unsupported_currencies_title')
    ];

    $config_message = $config->get('unsupported_currencies_message');
    $form['message']['unsupported_currencies_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for currency.'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    ];

    $form['message']['unsupported_currencies_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox Ok button'),
      '#default_value' => $config->get('unsupported_currencies_button')
    ];

    $form['message']['game_provider_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Game Provider Mapping for Unsupported Currency'),
      '#description' => $this->t('Game provider mapping. Pattern should be {game_provider_key}|{game provider name}'),
      '#default_value' => $config->get('game_provider_mapping')
    ];

    $form['message']['fallback_error_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fallback Error Title'),
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
      '#title' => $this->t('Fallback error button'),
      '#description' => $this->t('Fallback Error LightBox Ok button'),
      '#default_value' => $config->get('fallback_error_button')
    ];

    $form['safari_notif'] = [
      '#type' => 'details',
      '#title' => $this->t('Safari Notification Message'),
      '#group' => 'advanced',
    ];

    $config_safari = $config->get('safari_notif_message');
    $form['safari_notif']['safari_notif_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Safari Notification Message.'),
      '#default_value' => $config_safari['value'],
      '#format' => $config_safari['format'],
    ];

    return $form;
  }
}
