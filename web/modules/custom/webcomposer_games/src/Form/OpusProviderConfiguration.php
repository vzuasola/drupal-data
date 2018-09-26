<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Keno, Lottery, Opus Live Dealer Game Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "opus_provider_settings_form",
 *   route = {
 *     "title" = "Keno, Lottery, Opus Live Dealer Game Configuration",
 *     "path" = "/admin/config/webcomposer/games/opus",
 *   },
 *   menu = {
 *     "title" = "Keno, Lottery, Opus Live Dealer Game Configuration",
 *     "description" = "Provides configuration for Keno & Lottery Game",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 7
 *   },
 * )
 */
class OpusProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * ICore Playtech Provider Configuration
   */
  /**
   * ICore Playtech Provider Configuration
   */
    const OPUS_DEALER = [
        'opus_gen_config' => 'Opus General Configurations'
    ];

  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_opus_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['opus_provider_settings_form'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Opus Configurations'),
    );

    foreach (self::OPUS_DEALER as $key => $value) {
      $this->gpiContentTab($form[$key], $key, $value);
    }

    return $form;
  }

  private function gpiContentTab(&$form, $key, $value) {
    $config = $this->config('webcomposer_config.games_opus_provider');
    $content = $config->get('opus_game_loader_content');
    $message = $config->get('opus_unsupported_currencies_message');

    $form = array(
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'opus_provider_settings_form'
    );

    $form['opus_fallback_error'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fallback error'),
      '#description' => $this->t('Fallback error'),
      '#default_value' => $this->get('opus_fallback_error'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['opus_game_loader_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for country.'),
      '#default_value' => $this->get('opus_game_loader_content')['value'],
      '#required' => false,
      '#translatable' => TRUE,
      '#format' => $content['format'],
    ];

    $form['opus_game_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Opus Game url'),
      '#description' => $this->t('Opus Game url'),
      '#default_value' => $this->get('opus_game_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['opus_game_free_play_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Opus Free Play Game url'),
      '#description' => $this->t('Defines the Opus Free Play Games Url'),
      '#default_value' => $this->get('opus_game_free_play_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['opus_alternative_game_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Opus Alternate Game url'),
      '#description' => $this->t('Defines the alternate game url'),
      '#default_value' => $this->get('opus_alternative_game_url'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' =>  $this->t('Define the language mapping for Opus games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form['currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency'),
      '#description' => $this->t("Define the curency for opus games."),
      '#default_value' => $this->get('currency'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form['country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country'),
      '#description' => $this->t("Define the Unsupported Country code for Opus Keno games."),
      '#default_value' => $this->get('country'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form['opus_unsupported_currencies_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unsupported Currency title'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox title'),
      '#default_value' => $this->get('opus_unsupported_currencies_title'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['opus_unsupported_currencies_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Unsupported Currency Message'),
      '#default_value' => $this->get('opus_unsupported_currencies_message')['value'],
      '#required' => false,
      '#translatable' => TRUE,
      '#format' => $message['format'],
    ];

    $form['opus_unsupported_currencies_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lottey Unsupported Currency button'),
      '#description' => $this->t('Defines the Unsupported Currency LightBox Ok button'),
      '#default_value' => $this->get('opus_unsupported_currencies_button'),
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }
}
