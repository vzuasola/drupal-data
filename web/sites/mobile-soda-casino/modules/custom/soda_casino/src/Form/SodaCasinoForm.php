<?php

namespace Drupal\soda_casino\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "soda_casino",
 *   route = {
 *     "title" = "Mobile Soda Casino Configuration",
 *     "path" = "/admin/config/soda-casino-mobile/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Soda Casino Configuration",
 *     "description" = "Provides configuration for Soda Casino Mobile",
 *     "parent" = "soda_casino.list",
 *   },
 * )
 */
class SodaCasinoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['soda_casino.soda_casino_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Soda Casino General Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['general']['soda_casino_maintenance'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Maintenance Page'),
      '#default_value' => $this->get('soda_casino_maintenance'),
      '#description' => '',
      '#translatable' => TRUE,
    ];

    $form['general']['soda_casino_lobby_infinite_scroll'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable lobby lazy load (Infinite Scroll)'),
      '#default_value' => $this->get('soda_casino_lobby_infinite_scroll'),
      '#description' => 'Enable lazy loading for games lobby.',
      '#translatable' => TRUE,
    ];

    $form['general']['search_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Placeholder for Search Field'),
      '#description' => 'Placeholder text for Search Game field',
      '#default_value' => $this->get('search_placeholder'),
      '#required' => true,
      '#translatable' => true,
    ];

    return $form;
  }
}
