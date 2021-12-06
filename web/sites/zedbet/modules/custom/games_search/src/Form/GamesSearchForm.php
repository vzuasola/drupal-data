<?php

namespace Drupal\games_search\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Game Search Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "game_search_config_form",
 *   route = {
 *     "title" = "Game Search Configuration",
 *     "path" = "/admin/games/search-config",
 *   },
 *   menu = {
 *     "title" = "Game Search Configuration",
 *     "description" = "Configuration for game search UI",
 *     "parent" = "games_config.admin_settings",
 *     "weight" = 10
 *   },
 * )
 */
class GamesSearchForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.search_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['search_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Settings'),
    );

    $form['recommendations'] = array(
      '#type' => 'details',
      '#title' => $this->t('Recommendation Settings'),
      '#collapsible' => TRUE,
      '#group' => 'search_configuration_tab'
    );

    $recommendation_message = $this->get('recommendation_message');
    $form['recommendations']['recommendation_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Message'),
      '#description' => $this->t('The text to display on recommendation message.'),
      '#default_value' => $recommendation_message['value'],
      '#format' => $recommendation_message['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    $recommendation_message_negative = $this->get('recommendation_message_negative');
    $form['recommendations']['recommendation_message_negative'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Not Set Message'),
      '#description' => $this->t('The text to display on recommendation message when no recommendation is set.'),
      '#default_value' => $recommendation_message_negative['value'],
      '#format' => $recommendation_message_negative['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    $form['search'] = array(
      '#type' => 'details',
      '#title' => $this->t('Search Settings'),
      '#collapsible' => TRUE,
      '#group' => 'search_configuration_tab'
    );

    $form['search']['search_placeholder'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Search Field Placeholder'),
      '#description' => $this->t('The text to display as placeholder for search field.'),
      '#default_value' => $this->get('search_placeholder'),
      '#required' => TRUE,
      '#translatable' => true
    );
    $search_result_message = $this->get('search_result_message');
    $form['search']['search_result_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Search Result Message'),
      '#description' => $this->t('The text to display when search has result.'),
      '#default_value' => $search_result_message['value'],
      '#format' => $search_result_message['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    $form['filter'] = array(
      '#type' => 'details',
      '#title' => $this->t('Filter Settings'),
      '#collapsible' => TRUE,
      '#group' => 'search_configuration_tab'
    );

    $filter_message = $this->get('filter_message');
    $form['filter']['filter_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('No Result on Filter (with Recommendation)'),
      '#description' => $this->t('The text to display when there are no result for filter and recommendation is set.'),
      '#default_value' => $filter_message['value'],
      '#format' => $filter_message['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    $filter_message_negative = $this->get('filter_message_negative');
    $form['filter']['filter_message_negative'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('No Result on Filter (No Recommendation)'),
      '#description' => $this->t('The text to display when there are no result for filter and no recommendation.'),
      '#default_value' => $filter_message_negative['value'],
      '#format' => $filter_message_negative['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    return $form;
  }
}
