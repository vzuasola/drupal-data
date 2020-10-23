<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_game_provider_integration",
 *   route = {
 *     "title" = "Game Provider Configuration",
 *     "path" = "/admin/config/zipang/game_provider_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Provider Configuration",
 *     "description" = "Provides Game Provider configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangGameProviderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.game_provider_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Game Provider Configurations'),
    ];

    $this->sectionGeneralConfig($form);
    $this->sectionPlaytechGameProvider($form);
    $this->sectionVoidbridgeGameProvider($form);

    return $form;
  }

  private function sectionGeneralConfig(array &$form) {

    $form['general'] = [
      '#type' => 'details',
      '#title' => t('General'),
      '#group' => 'advanced',
    ];

    $form['general']['gamelaunch_error_message_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Launch Error Message Title'),
      '#default_value' => $this->get('gamelaunch_error_message_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('gamelaunch_error_message');
    $form['general']['gamelaunch_error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Game Launch Error Message'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }

  private function sectionPlaytechGameProvider(array &$form) {

    $form['playtech'] = [
      '#type' => 'details',
      '#title' => t('Playtech'),
      '#group' => 'advanced',
    ];

    $form['playtech']['playtech_language_map'] = [
      '#type' => 'textarea',
      '#title' => t('Language Map'),
      '#default_value' => $this->get('playtech_language_map'),
      '#required' => TRUE,
    ];

    $form['playtech']['playtech_ngm_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM Client'),
      '#default_value' => $this->get('playtech_ngm_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['playtech']['playtech_ngm2dt_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('NGM2DT Client'),
      '#default_value' => $this->get('playtech_ngm2dt_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['playtech']['playtech_live_mobile_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Mobile Games Client'),
      '#default_value' => $this->get('playtech_live_mobile_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['playtech']['playtech_live_desktop_client_url'] = [
      '#type' => 'textarea',
      '#title' => t('Live Desktop Games Client'),
      '#default_value' => $this->get('playtech_live_desktop_client_url'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];
  }

  private function sectionVoidbridgeGameProvider(array &$form) {

    $form['voidbridge'] = [
      '#type' => 'details',
      '#title' => t('Voidbridge'),
      '#group' => 'advanced',
    ];

    $form['voidbridge']['voidbridge_language_map'] = [
      '#type' => 'textarea',
      '#title' => t('Language Map'),
      '#default_value' => $this->get('voidbridge_language_map'),
      '#required' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  }
