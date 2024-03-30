<?php

namespace Drupal\mobile_arcade\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games Search configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_arcade_search",
 *   route = {
 *     "title" = "Arcade Search Configuration",
 *     "path" = "/admin/config/arcade-mobile/search/configuration",
 *   },
 *   menu = {
 *     "title" = "Arcade Search Configuration",
 *     "description" = "Provides a form for customizing games search module",
 *     "parent" = "mobile_arcade.list",
 *   },
 * )
 */
class GamesSearchArcadeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_arcade.search_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['search_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Games Search & Filter Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['search_configuration']['title_search_lightbox'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Title Lightbox'),
      '#default_value' => $this->get('title_search_lightbox'),
      '#translatable' => TRUE,
      '#required' => FALSE,
    ];

    $form['search_configuration']['filter_title_lightbox'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Title Lightbox'),
      '#default_value' => $this->get('filter_title_lightbox'),
      '#translatable' => TRUE,
      '#required' => FALSE,
    ];

    $form['search_configuration']['games_filter_submit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Submit Button'),
      '#default_value' => $this->get('games_filter_submit'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['games_filter_cancel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Cancel Button'),
      '#default_value' => $this->get('games_filter_cancel'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['games_filter_hide'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Filter for Arcade Lobby'),
      '#default_value' => $this->get('games_filter_hide'),
      '#description' => 'Hide Filter for Arcade Lobby.',
      '#translatable' => TRUE,
    ];

    $form['search_configuration']['search_v2'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use v2 search'),
      '#default_value' => $this->get('search_v2'),
      '#description' => 'Use Lobby search function',
      '#translatable' => TRUE,
    ];

    $form['search_configuration']['search_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Blurb. You may use {keyword}, {count} placeholders.'),
      '#default_value' => $this->get('search_blurb'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['search_no_result_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default message for zero results in search result. You may use {keyword} placeholder.'),
      '#default_value' => $this->get('search_no_result_msg'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['filter_no_result_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default message for zero results in filter result.'),
      '#default_value' => $this->get('filter_no_result_msg'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['msg_recommended_available'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message when Recommended Games are available.'),
      '#default_value' => $this->get('msg_recommended_available'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['msg_no_recommended'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message when No Recommended Games are available.'),
      '#default_value' => $this->get('msg_no_recommended'),
      '#translatable' => TRUE,
    ];

    $form['search_configuration']['title_weight'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Title weight'),
      '#default_value' => $this->get('title_weight'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['keywords_weight'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Keywords weight'),
      '#default_value' => $this->get('keywords_weight'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    return $form;
  }
}
