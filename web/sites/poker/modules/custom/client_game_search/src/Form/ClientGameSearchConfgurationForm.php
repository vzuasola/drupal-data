<?php

namespace Drupal\client_game_search\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Client search custom config form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "search_config",
 *   route = {
 *     "title" = "Search Configuration",
 *     "path" = "/admin/search/config",
 *   },
 *   menu = {
 *     "title" = "Search Configuration",
 *     "description" = "Configure search configuration",
 *     "parent" = "poker_config.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class ClientGameSearchConfgurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['poker_config.search_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['client_search_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];
    $this->recommendationSection($form);
    $this->searchSection($form);
    return $form;
  }

  private function searchSection(&$form) {
    $form['search_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Search configuration'),
      '#collapsible' => TRUE,
      '#group' => 'client_search_tab'
    ];
    $form['search_group']['search_placeholder'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Search Field Placeholder'),
      '#description' => $this->t('The text to display as placeholder for search field.'),
      '#default_value' => $this->get('search_placeholder'),
      '#required' => TRUE,
    );

    $resultMessage = $this->get('search_result_message');
    $form['search_group']['search_result_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Search Result Message'),
      '#description' => $this->t('The text to display when search has result.'),
      '#default_value' => $resultMessage['value'] ?? null,
      '#format' => $resultMessage['format'],
      '#required' => TRUE,
    );
  }
  private function recommendationSection(&$form) {
    $form['recommendation_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Recommendation Settings'),
      '#collapsible' => TRUE,
      '#group' => 'client_search_tab'
    );
    
    $recommendation_message = $this->get('recommendation_message');
    $form['recommendation_group']['recommendation_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Message'),
      '#description' => $this->t('The text to display on recommendation message.'),
      '#default_value' => $recommendation_message['value'] ?? null,
      '#format' => $recommendation_message['format'],
      '#required' => TRUE,
    );
    
    $recommendation_message_negative = $this->get('recommendation_message_negative');
    $form['recommendation_group']['recommendation_message_negative'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Not Set Message'),
      '#description' => $this->t('The text to display on recommendation message when no recommendation is set.'),
      '#default_value' => $recommendation_message_negative['value'] ?? null,
      '#format' => $recommendation_message_negative['format'],
      '#required' => TRUE,
    );
  }
}
