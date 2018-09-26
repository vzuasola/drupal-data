<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Playtech Provider Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "playtech_provider_settings_form",
 *   route = {
 *     "title" = "Playtech Provider Configuration",
 *     "path" = "/admin/config/webcomposer/games/playtech",
 *   },
 *   menu = {
 *     "title" = "Playtech Provider Configuration",
 *     "description" = "Provides configuration for Playtech game provider",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 8
 *   },
 * )
 */
class PlaytechProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Playtech Provider Configuration
   */
  /**
   * Playtech Provider Configuration
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_playtech_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_playtech_provider_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get('javascript_assets'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['playtech_pas_casino'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech PAS Casino'),
      '#description' => $this->t('Defines the casino value used for authenticating PAS'),
      '#default_value' => $this->get('playtech_pas_casino'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for Playtech games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['iapiconf_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iapiConf Override'),
      '#description' => $this->t('Define iapiConf to be overrided prior PAS initalization
          <br>
          If no mapping specified, it will use the the default config from Playtech
          <br>
          <strong>clientUrl_casino|https://cachebanner.9bonus.com/casinoclient.html</strong>'),
      '#default_value' => $this->get('iapiconf_override'),
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }

}