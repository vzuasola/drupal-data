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
    'ky_gaming' => 'Kaiyuan (KY) Gaming',
    'pgsoft' => 'Pocket Games Soft',
    'ruby_play' => 'Ruby Play',
    'ezugi_gaming' => 'Ezugi Gaming',
    'wac' => 'We Are Casino',
    'lottoland' => 'Lottoland',
    'onegame' => 'OneGame',
    'jsystem' => 'JSystem',
    'fghub_gaming' => 'FGHub Gaming',
    'ptplus' => 'PTPlus Playtech',
    'pas' => 'Playtech',
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
      if ('pas' === $key) {
        $this->getPasFields($form[$key], $key, $value);
      } else {
        $this->getBaseFieldsTab($form[$key], $key, $value);
      }


      switch ($key) {
        case 'gameworx_lottery':
        case 'gameworx_quicklotto':
          $this->getGameWorksFields($form[$key], $key, $value);
          break;

        case 'betconstruct':
          $this->getBetContructFields($form[$key], $key, $value);
          break;

        case 'asia_gaming':
          $this->getAsiaGamingFields($form[$key], $key, $value);
          break;

        case 'ruby_play':
            $this->getRubyPlayFields($form[$key], $key, $value);
            break;

        case 'pgsoft':
          $this->getPGSoftFields($form[$key], $key, $value);
          break;

        case 'lottoland':
            $this->getLottolandFields($form[$key], $key, $value);
            break;

        case 'pas':
          $this->getPasFields($form[$key], $key, $value);
          break;

        default:
          break;
      }
    }

    $this->safariNotifTab($form);
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

    $form[$key . '_use_playergame_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use PlayerGame API'),
      '#description' => $this->t("Use PlayerGame API on game launching for " . $value),
      '#default_value' => $this->get($key . '_use_playergame_api'),
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

  /**
   * Adds additional form fields for Asian Gaming Provider
   *
   * @param $form
   * @param $key
   * @param $value
   */
  private function getAsiaGamingFields(&$form, $key, $value) {
    $form[$key . '_custom_lobbyDomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Custom Lobby Domain'),
      '#description' => $this->t("The domain that will replace the lobbyURL parameter."),
      '#default_value' => $this->get($key . '_custom_lobbyDomain'),
      '#translatable' => TRUE,
      '#required' => false,
    ];

    $form[$key . '_custom_lobbyDomain_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use custom lobby Domain'),
      '#description' => $this->t("If enabled, Custom Lobby Domain field will overwrite the lobbyURL parameter."),
      '#default_value' => $this->get($key . '_custom_lobbyDomain_enabled'),
      '#translatable' => TRUE,
      '#required' => false,
    ];
  }

  /**
   * Adds additional form fields for Ruby Play tabs
   *
   * @param $form
   * @param $key
   * @param $value
   */
  private function getRubyPlayFields(&$form, $key, $value) {
    $form[$key . '_geoip_domain_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('GeoIP domain'),
      '#description' => $this->t("Override the game URL domain base from Geo IP. <br />Use pipe (|) pattern (GeoIP|DomainOverride|server_urlParamOverride)"),
      '#default_value' => $this->get($key . '_geoip_domain_override'),
      '#translatable' => false,
      '#required' => false,
    ];
  }

  /**
   * Adds additional form fields for PGSoft tabs
   *
   * @param $form
   * @param $key
   * @param $value
   */
  private function getPGSoftFields(&$form, $key, $value) {
    $form[$key . '_geoip_domain_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('GeoIP domain'),
      '#description' => $this->t("Override the game URL domain base from Geo IP. <br />Use pipe (|) pattern (GeoIP|DomainOverride|server_urlParamOverride)"),
      '#default_value' => $this->get($key . '_geoip_domain_override'),
      '#translatable' => false,
      '#required' => false,
    ];
  }

  /**
   * Adds additional form fields for Lottoland tabs
   *
   * @param $form
   * @param $key
   * @param $value
   */
  private function getLottolandFields(&$form, $key, $value) {
    $form[$key . '_javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t("Define scripts that should be included on game launch. Provide one script per line"),
      '#default_value' => $this->get($key . '_javascript_assets'),
      '#translatable' => false,
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

}
