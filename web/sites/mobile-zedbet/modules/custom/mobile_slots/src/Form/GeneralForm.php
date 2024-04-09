<?php

namespace Drupal\mobile_slots\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_slots_general",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/slots-mobile/general/configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides configuration for Slots Mobile",
 *     "parent" = "mobile_slots.list",
 *   },
 * )
 */
class GeneralForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_slots.general_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Games Genral Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['general']['use_games_list_v2'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Games List V2'),
      '#default_value' => $this->get('use_games_list_v2'),
      '#description' => 'Tick to use version 2 of Games List View',
      '#translatable' => FALSE,
    ];

    $form['general']['lobby_infinite_scroll'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable lobby lazy load (Infinite Scroll)'),
      '#default_value' => $this->get('lobby_infinite_scroll'),
      '#description' => 'Enable lazy loading for games lobby.',
      '#translatable' => TRUE,
    ];

    $form['general']['more_provider_drawer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More'),
      '#description' => 'More',
      '#default_value' => $this->get('more_provider_drawer'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['general']['title_provider_drawer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Providers'),
      '#description' => 'Game Providers',
      '#default_value' => $this->get('title_provider_drawer'),
      '#required' => true,
      '#translatable' => true,
    ];

    return $form;
  }
}
