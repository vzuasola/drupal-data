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
      '#title' => $this->t('Games Search Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['search_configuration']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $form['search_configuration']['search_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Blurb'),
      '#default_value' => $this->get('search_blurb'),
      '#required' => TRUE,
    ];

    $form['search_configuration']['no_result_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default message (for zero results)'),
      '#default_value' => $this->get('no_result_msg'),
      '#required' => TRUE,
    ];

    $form['search_configuration']['title_weight'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Title weight'),
      '#default_value' => $this->get('title_weight'),
      '#translatable' => TRUE,
    ];

    $form['search_configuration']['keywords_weight'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Keywords weight'),
      '#default_value' => $this->get('keywords_weight'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
