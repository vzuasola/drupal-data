<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Goldenrace Game Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "golden_race_form",
 *   route = {
 *     "title" = "Goldenrace Game Configuration",
 *     "path" = "/admin/config/webcomposer/games/goldenrace",
 *   },
 *   menu = {
 *     "title" = "Goldenrace Game Configuration",
 *     "description" = "Provides configuration for GoldenRace Game",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 4
 *   },
 * )
 */
class GoldenRaceProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Golden race Game Providers definitions
   */
  /**
   * Golden race Game Providers definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.golden_race_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_goldenrace_provider_form'] = [
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
      '#description' => $this->t('Define the GlobalBet scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get('javascript_assets'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['languages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Define the language mapping for Goldenrace games. Pipe separated language code and value, one per line.
          <br>
          If no mapping specified, it will use the front end language prefix as is.
          <br>
          <strong>en|en-us</strong>'),
      '#default_value' => $this->get('languages'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency'),
      '#description' => $this->t('Define the curency for goldenrace games.'),
      '#default_value' => $this->get('currency'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Define the Unsupported Country code for Asia Gaming games.'),
      '#default_value' => $this->get('country'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

  }

}