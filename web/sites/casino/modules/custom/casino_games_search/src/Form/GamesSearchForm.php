<?php

namespace Drupal\casino_games_search\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesSearchForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_games_search.search_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'casino_games_search.search_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_games_search.search_configuration');

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
    );

    foreach ($keys as $key) {
      $this->config('casino_games_search.search_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
