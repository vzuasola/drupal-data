<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * FIM Provider Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "fim_provider_settings_form",
 *   route = {
 *     "title" = "FIM Provider Configuration",
 *     "path" = "/admin/config/webcomposer/games/fim",
 *   },
 *   menu = {
 *     "title" = "FIM Provider Configuration",
 *     "description" = "Provides configuration for FIM game provider",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 2
 *   },
 * )
 */
class FimProviderConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * FIM Provider Configuration definitions
   */
  /**
   * FIM Provider Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_fim_provider'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_fim_provider_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['playtech_fim_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech FIM Endpoint'),
      '#description' => $this->t('Defines the endpoint used for authenticating FIM'),
      '#default_value' => $this->get('playtech_fim_endpoint'),
      '#required' => false,
      '#translatable' => false,
    ];

  }

}