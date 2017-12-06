<?php

namespace Drupal\games_search\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesSearchForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games.search_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'games_search.search_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('games.search_configuration');

    $form['search_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['recommendations'] = array(
      '#type' => 'details',
      '#title' => $this->t('Recommendation Settings'),
      '#collapsible' => TRUE,
      '#group' => 'search_configuration_tab'
    );

    $recommendation_message = $config->get('recommendation_message');
    $form['recommendations']['recommendation_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Message'),
      '#description' => $this->t('The text to display on recommendation message.'),
      '#default_value' => $recommendation_message['value'],
      '#format' => $recommendation_message['format'],
      '#required' => TRUE,
    );

    $recommendation_message_negative = $config->get('recommendation_message_negative');
    $form['recommendations']['recommendation_message_negative'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Recommendation Not Set Message'),
      '#description' => $this->t('The text to display on recommendation message when no recommendation is set.'),
      '#default_value' => $recommendation_message_negative['value'],
      '#format' => $recommendation_message_negative['format'],
      '#required' => TRUE,
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
      '#default_value' => $config->get('search_placeholder'),
      '#required' => TRUE,
    );
    $search_result_message = $config->get('search_result_message');
    $form['search']['search_result_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Search Result Message'),
      '#description' => $this->t('The text to display when search has result.'),
      '#default_value' => $search_result_message['value'],
      '#format' => $search_result_message['format'],
      '#required' => TRUE,
    );

    $form['filter'] = array(
      '#type' => 'details',
      '#title' => $this->t('Filter Settings'),
      '#collapsible' => TRUE,
      '#group' => 'search_configuration_tab'
    );

    $filter_message = $config->get('filter_message');
    $form['filter']['filter_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('No Result on Filter (with Recommendation)'),
      '#description' => $this->t('The text to display when there are no result for filter and recommendation is set.'),
      '#default_value' => $filter_message['value'],
      '#format' => $filter_message['format'],
      '#required' => TRUE,
    );

    $filter_message_negative = $config->get('filter_message_negative');
    $form['filter']['filter_message_negative'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('No Result on Filter (No Recommendation)'),
      '#description' => $this->t('The text to display when there are no result for filter and no recommendation.'),
      '#default_value' => $filter_message_negative['value'],
      '#format' => $filter_message_negative['format'],
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $keys = array(
      'recommendation_message',
      'recommendation_message_negative',
      'filter_message',
      'filter_message_negative',
      'search_placeholder',
      'search_result_message',
    );

    foreach ($keys as $key) {
      $this->config('games.search_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
