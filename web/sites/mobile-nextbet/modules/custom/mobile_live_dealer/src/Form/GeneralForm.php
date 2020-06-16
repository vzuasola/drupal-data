<?php

namespace Drupal\mobile_live_dealer\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_live_dealer_general",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/live-dealer-mobile/general/configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides configuration for Live Dealer Mobile",
 *     "parent" = "mobile_live_dealer.list",
 *   },
 * )
 */
class GeneralForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_live_dealer.general_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Live Dealer General Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
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

    $form['general']['all_quicklaunch_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('All'),
      '#description' => 'Label for All tab in quick launch tabs',
      '#default_value' => $this->get('all_quicklaunch_title'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['general']['all_quicklaunch_alt'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Alt Text for All tab'),
      '#description' => 'Alt text for All tab in quick launch tabs',
      '#default_value' => $this->get('all_quicklaunch_alt'),
      '#required' => false,
      '#translatable' => true,
    ];

    $form['general']['games_transfer_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Instant Transfer Title'),
      '#default_value' => $this->get('games_transfer_title'),
      '#translatable' => true,
      '#required' => false,
    ];

    $form['general']['games_transfer_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Instant Transfer URL'),
      '#default_value' => $this->get('games_transfer_link'),
      '#translatable' => true,
    ];

    $form['general']['transfer_link_target'] = [
      '#type' => 'select',
      '#title' => $this->t('Instant Transfer link target'),
      '#options' => [
        '_blank' => $this->t('New Window'),
        '_self' => $this->t('Same Window')
      ],
      '#default_value' => $this->get('transfer_link_target'),
      '#translatable' => TRUE,
    ];

    $form['general']['games_maintenance_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Games maintenance text'),
      '#default_value' => $this->get('games_maintenance_text'),
      '#translatable' => true,
    ];
    return $form;
  }
}
