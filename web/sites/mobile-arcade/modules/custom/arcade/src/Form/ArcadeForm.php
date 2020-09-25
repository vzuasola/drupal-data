<?php

namespace Drupal\arcade\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "arcade",
 *   route = {
 *     "title" = "Mobile Arcade Configuration",
 *     "path" = "/admin/config/arcade-mobile/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Arcade Configuration",
 *     "description" = "Provides configuration for Arcade Mobile",
 *     "parent" = "arcade.list",
 *   },
 * )
 */
class ArcadeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['arcade.arcade_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Arcade General Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['general']['arcade_lobby_infinite_scroll'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable lobby lazy load (Infinite Scroll)'),
      '#default_value' => $this->get('arcade_lobby_infinite_scroll'),
      '#description' => 'Enable lazy loading for games lobby.',
      '#translatable' => false,
    ];

    $form['general']['more_provider_drawer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More'),
      '#description' => 'More Text in Providers Drawer',
      '#default_value' => $this->get('more_provider_drawer'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['general']['title_provider_drawer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Categories'),
      '#description' => 'Title of Categories Drawer',
      '#default_value' => $this->get('title_provider_drawer'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['general']['search_tab_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Search Tab Title'),
        '#description' => 'Search Tab Text',
        '#default_value' => $this->get('search_tab_title'),
        '#required' => true,
        '#translatable' => true,
      ];

      $form['general']['provider_tab_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Providers Tab Title'),
        '#description' => 'Providers Tab Text',
        '#default_value' => $this->get('provider_tab_title'),
        '#required' => true,
        '#translatable' => true,
      ];

      $form['general']['transfer_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Instant Transfer Title'),
        '#default_value' => $this->get('transfer_title'),
        '#translatable' => true,
        '#required' => false,
      ];

      $form['general']['transfer_link'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Instant Transfer URL'),
        '#default_value' => $this->get('transfer_link'),
        '#translatable' => true,
      ];

      $form['graphyte'] = [
        '#type' => 'details',
        '#title' => $this->t('Graphyte Configuration'),
        '#collapsible' => TRUE,
        '#open' => TRUE,
      ];

      $form['graphyte']['asset'] = [
        '#type' => 'textfield',
        '#title' => $this->t('API URL'),
        '#default_value' => $this->get('asset'),
        '#translatable' => false,
      ];

      $form['graphyte']['api_key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('API Key (ClickStream)'),
        '#default_value' => $this->get('api_key'),
        '#translatable' => false,
      ];

      $form['graphyte']['brand_key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Brand Key'),
        '#default_value' => $this->get('brand_key'),
        '#translatable' => false,
      ];

      $form['graphyte']['enable_clickstream'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable Graphyte Clickstream'),
        '#default_value' => $this->get('enable_clickstream'),
        '#description' => 'Enable sending of pageviews/game tracking to graphyte via clickstream',
        '#translatable' => false,
      ];

    return $form;
  }
}
