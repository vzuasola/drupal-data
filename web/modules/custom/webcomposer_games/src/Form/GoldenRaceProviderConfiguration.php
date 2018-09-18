<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Gpi Configuration Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "gpi_config_form",
 *   route = {
 *     "title" = "Gpi Configuration Form",
 *     "path" = "/admin/config/webcomposer/games/goldenrace",
 *   },
 *   menu = {
 *     "title" = "Gpi Configuration Form",
 *     "description" = "Provides Gpi Configuration Form",
 *     "parent" = "webcomposer_config.list",
 *     "weight" = -5
 *   },
 * )
 */
class GoldenRaceProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Gpi Game Providers definitions
   */
  /**
   * Gpi Game Providers definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.golden_race_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['gpi_provider_settings_form'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['javascript_assets'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Javascript Assets'),
      '#description' => $this->t('Define the GlobalBet scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->get('javascript_assets'),
      '#required' => false,
      '#translatable' => TRUE,
    );

    $form['gen_config']['languages'] = array(
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
    );

    $form['gen_config']['currency'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Currency'),
      '#description' => $this->t('Define the curency for goldenrace games.'),
      '#default_value' => $this->get('currency'),
      '#required' => false,
      '#translatable' => TRUE,
    );

    $form['gen_config']['country'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Define the Unsupported Country code for Asia Gaming games.'),
      '#default_value' => $this->get('currency'),
      '#required' => false,
      '#translatable' => TRUE,
    );

  }

}