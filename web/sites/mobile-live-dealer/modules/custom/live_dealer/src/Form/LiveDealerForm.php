<?php

namespace Drupal\live_dealer\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Live Dealer configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "live_dealer",
 *   route = {
 *     "title" = "Live Dealer Mobile Configuration",
 *     "path" = "/admin/config/live-dealer-mobile/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Live Dealer Configuration",
 *     "description" = "Provides configuration for Live Dealer Mobile",
 *     "parent" = "live_dealer.list",
 *   },
 * )
 */
class LiveDealerForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['live_dealer.live_dealer_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Live Dealer Genral Configuration'),
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
    return $form;
  }
}
