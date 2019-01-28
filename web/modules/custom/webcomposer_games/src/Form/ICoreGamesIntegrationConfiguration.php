<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ICore Games Integration Configuration Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "icore_games_integration_form",
 *   route = {
 *     "title" = "ICore Games Integration Configuration",
 *     "path" = "/admin/config/webcomposer/games/icore",
 *   },
 *   menu = {
 *     "title" = "ICore Games Integration Configuration",
 *     "description" = "Provides configuration for icore games integration",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 5
 *   },
 * )
 */
class ICoreGamesIntegrationConfiguration extends FormBase {

  /**
   * ICore Games Integration Configuration Form
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
    'betconstruct' => 'BetConstruct',
    'fun_gaming' => 'Fun Gaming',
    'micro_gaming' => 'Micro Gaming',
    'flow_gaming' => 'Flow Gaming',
  ];

  protected function getEditableConfigNames() {
    return ['webcomposer_config.icore_games_integration'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['icore_games_integration_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    foreach (self::ICORE_GAME_PROVIDERS as $key => $value) {
      $this->getBaseFieldsTab($form[$key], $key, $value);

      switch ($key) {
        case 'gameworx_lottery':
        case 'gameworx_quicklotto':
            $this->getGameWorksFields($form[$key], $key, $value);
          break;

        case 'betconstruct':
            $this->getBetContructFields($form[$key], $key, $value);
          break;

        default:
          break;
      }
    }

    $this->safariNotifTab($form);
    $this->unsupportedCurrencyTab($form);
    return $form;
  }

  private function getBaseFieldsTab(&$form, $key, $value) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'icore_games_integration_form'
    ];

    $form[$key . '_currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currencies'),
      '#description' => $this->t("Currency mapping for " . $value),
      '#default_value' => $this->get($key . '_currency'),
      '#translatable' => false,
      '#required' => false,
    ];

    $form[$key . '_language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t("Language mapping for " . $value),
      '#default_value' => $this->get($key . '_language_mapping'),
      '#translatable' => false,
      '#required' => false,
    ];

    $form[$key . '_country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country'),
      '#description' => $this->t("Define the unsupported country code for " . $value),
      '#default_value' => $this->get($key . '_country'),
      '#translatable' => false,
      '#required' => false,
    ];
  }

  private function getGameWorksFields(&$form, $key, $value) {
    $form[$key . '_lobby_type'] = [
      '#type' => 'textfield',
      '#title' => $this->t('LobbyType'),
      '#description' => $this->t("Please enter lobby type."),
      '#default_value' => $this->get($key . '_lobby_type'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_operator_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Operator ID'),
      '#description' => $this->t("Please enter Operator ID."),
      '#default_value' => $this->get($key . '_operator_id'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_plugin_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Plugin ID'),
      '#description' => $this->t("Please enter Operator ID."),
      '#default_value' => $this->get($key . '_plugin_id'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_realitycheck_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reality Check URL'),
      '#description' => $this->t("Please enter Reality CheckUrl."),
      '#default_value' => $this->get($key . '_realitycheck_url'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_deposit_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Deposit Url'),
      '#description' => $this->t("Please enter Deposit Url."),
      '#default_value' => $this->get($key . '_deposit_url'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_exit_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Exit URL'),
      '#description' => $this->t("Please enter Exit Url."),
      '#default_value' => $this->get($key . '_exit_url'),
      '#translatable' => TRUE,
      '#required' => false,
    ];
  }

  private function getBetContructFields(&$form, $key, $value) {
    $form['betconstruct_container_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Container ID'),
      '#description' => $this->t("The ID of html element where BetConstruct will be inserted."),
      '#default_value' => $this->get('betconstruct_container_id'),
      '#translatable' => TRUE,
      '#required' => false,
    ];
  }

  private function safariNotifTab(&$form) {

    $form['message'] = [
      '#type' => 'details',
      '#title' => $this->t('Safari Notification Message'),
      '#collapsible' => TRUE,
      '#group' => 'icore_games_integration_form'
    ];

   $form['message']['safari_notif'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Safari Notification Message.'),
      '#default_value' => $this->get('safari_notif')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];

  }

  private function unsupportedCurrencyTab(&$form) {
    $form['currency'] = [
      '#type' => 'details',
      '#title' => $this->t('[Decprecated] Unsupported Currency Message'),
      '#collapsible' => TRUE,
      '#group' => 'icore_games_integration_form'
    ];

    $form['currency']['fallback_error_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fallback Error Title'),
      '#description' => $this->t('Defines the GPI Game Url'),
      '#default_value' => $this->get('fallback_error_title'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

   $form['currency']['fallback_error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Fallback error button'),
      '#description' => $this->t('Fallback Error Message'),
      '#default_value' => $this->get('fallback_error_message')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];

   $form['currency']['fallback_error_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Fallback error button'),
      '#description' => $this->t('Fallback Error LightBox Ok button'),
      '#default_value' => $this->get('fallback_error_button'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

  }
}