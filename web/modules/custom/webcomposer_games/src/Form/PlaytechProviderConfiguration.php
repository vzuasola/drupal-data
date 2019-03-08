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

    $this->integrationConfig($form['integration_config']);
    $this->errorHandlingConfig($form['error_handling_config']);
    return $form;
  }

  private function integrationConfig(&$form) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Integration Settings'),
      '#collapsible' => true,
      '#group' => 'games_playtech_provider_form',
      '#access' => !$this->isTranslated() // Hide the integration config since all fields are non translatable
    ];

    // This field is temporary
    // Will be removed once futurama has been deployed to production and all sites have done the PAS cleanup.
    $form['futurama_switch'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Futurama'),
      '#description' => $this->t('This will enable futurama features.
       This will disable the PAS login during player login and will transfer the logic on Game launch'),
      '#default_value' => $this->get('futurama_switch'),
    ];

    $form['javascript_assets'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get('javascript_assets'),
      '#required' => false,
    ];

    $form['playtech_pas_casino'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech PAS Casino'),
      '#description' => $this->t('Defines the casino value used for authenticating PAS'),
      '#default_value' => $this->get('playtech_pas_casino'),
      '#required' => false
    ];

    $form['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for Playtech games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#required' => false
    ];

    $form['iapiconf_override'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iapiConf Override'),
      '#description' => $this->t('Define iapiConf to be overrided prior PAS initalization
          <br>
          If no mapping specified, it will use the the default config from Playtech
          <br>
          <strong>clientUrl_casino|https://cachebanner.9bonus.com/casinoclient.html</strong>'),
      '#default_value' => $this->get('iapiconf_override'),
      '#required' => false
    ];
  }

  private function errorHandlingConfig(&$form) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t('Error Handling'),
      '#collapsible' => TRUE,
      '#group' => 'games_playtech_provider_form'
    ];

    $form['error_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Mapping'),
      '#description' => $this->t('Define error messages for corresponding PAS error codes<br/>
          pattern: <strong>code|message</strong><br/>
          special codes: <br/>
           - <i>all</i>: Generic handler '),
      '#default_value' => $this->get('error_mapping'),
      '#translatable' => true,
      '#rows' => 10
    ];
  }
}