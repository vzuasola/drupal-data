<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_game_integration",
 *   route = {
 *     "title" = "Game Integration Configuration",
 *     "path" = "/admin/config/zipang/game_integration_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Integration Configuration",
 *     "description" = "Provides Game Integration configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangGameIntegrationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.game_integration_configuration'];
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

    $form['game_integration'] = [
      '#type' => 'details',
      '#title' => t('Game Client Configuration'),
      '#group' => 'advanced',
    ];

    $form['game_integration']['ngm_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM Client'),
      '#default_value' => $this->get('ngm_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_integration']['ngm2dt_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM2DT Client'),
      '#default_value' => $this->get('ngm2dt_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_integration']['live_mobile_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Mobile Games Client'),
      '#default_value' => $this->get('live_mobile_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_integration']['live_desktop_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Desktop Games Client'),
      '#default_value' => $this->get('live_desktop_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_integration']['gpas_desktop_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('GPAS Desktop Games Client'),
      '#default_value' => $this->get('gpas_desktop_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['game_integration']['gpas_mobile_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('GPAS Mobile Games Client'),
      '#default_value' => $this->get('gpas_mobile_client_url'),
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
