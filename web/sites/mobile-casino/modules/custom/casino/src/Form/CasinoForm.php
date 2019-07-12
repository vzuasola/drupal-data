<?php

namespace Drupal\casino\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "casino",
 *   route = {
 *     "title" = "Casino Mobile Configuration",
 *     "path" = "/admin/config/casino-mobile/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Casino Configuration",
 *     "description" = "Provides configuration for Casino Mobile",
 *     "parent" = "casino.list",
 *   },
 * )
 */
class CasinoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino.casino_configuration'];
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
