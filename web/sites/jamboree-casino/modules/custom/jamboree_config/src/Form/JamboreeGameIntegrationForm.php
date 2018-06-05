<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_game_integration",
 *   route = {
 *     "title" = "Game Integration Configuration",
 *     "path" = "/admin/config/jamboree/game_integration_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Integration Configuration",
 *     "description" = "Provides Game Integration configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeGameIntegrationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.game_integration_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Game Integration Configurations'),
    ];

    $this->sectionGameIntegration($form);

    return $form;
  }

  private function sectionGameIntegration(array &$form) {

    $form['mobile_game_integration'] = [
      '#type' => 'details',
      '#title' => t('Mobile Client Game Configuration'),
      '#group' => 'advanced',
    ];

    $form['mobile_game_integration']['mobile_ngm_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM Client'),
      '#default_value' => $this->get('mobile_ngm_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['mobile_game_integration']['mobile_html5_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('HTML5 Client'),
      '#default_value' => $this->get('mobile_html5_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['mobile_game_integration']['mobile_live_games_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Games Client'),
      '#default_value' => $this->get('mobile_live_games_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['desktop_game_integration'] = [
      '#type' => 'details',
      '#title' => t('Desktop Client Game Configuration'),
      '#group' => 'advanced',
    ];

    $form['desktop_game_integration']['desktop_ngm_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM Client'),
      '#default_value' => $this->get('desktop_ngm_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['desktop_game_integration']['desktop_html5_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('HTML5 Client'),
      '#default_value' => $this->get('desktop_html5_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['desktop_game_integration']['desktop_live_games_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Games Client'),
      '#default_value' => $this->get('desktop_live_games_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_buttons_config'] = [
      '#type' => 'details',
      '#title' => t('Game Launch Buttons Configuration'),
      '#group' => 'advanced',
    ];

    $form['game_buttons_config']['real_play_button'] = [
      '#type' => 'textarea',
      '#title' => t('Real Play Button Text'),
      '#default_value' => $this->get('real_play_button'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_buttons_config']['free_play_button'] = [
      '#type' => 'textarea',
      '#title' => t('Free Play Button Text'),
      '#default_value' => $this->get('free_play_button'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
  }
