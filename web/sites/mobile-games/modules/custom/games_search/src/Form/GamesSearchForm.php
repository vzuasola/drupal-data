<?php

namespace Drupal\games_search\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games Search configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_search",
 *   route = {
 *     "title" = "Games Search Configuration",
 *     "path" = "/admin/config/games_search/configuration",
 *   },
 *   menu = {
 *     "title" = "Games Search Configuration",
 *     "description" = "Provides a form for customizing games search module",
 *     "parent" = "games_search.list",
 *   },
 * )
 */
class GamesSearchForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_search.search_configuration'];
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

    $form['search_configuration']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['games_filter_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filter Title'),
      '#default_value' => $this->get('games_filter_title'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['search_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Blurb. You may use {keyword}, {count} placeholders.'),
      '#default_value' => $this->get('search_blurb'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['no_result_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default message for zero results in search result. You may use {keyword} placeholder.'),
      '#default_value' => $this->get('no_result_msg'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['search_configuration']['no_result_msg_filter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default message for zero results in filter result. You may use {keyword} placeholder.'),
      '#default_value' => $this->get('no_result_msg_filter'),
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

    $form['search_configuration']['msg_no_recommended_available'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message when No Recommended Games are available.'),
      '#default_value' => $this->get('msg_no_recommended'),
      '#translatable' => TRUE,
      '#required' => TRUE,
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
