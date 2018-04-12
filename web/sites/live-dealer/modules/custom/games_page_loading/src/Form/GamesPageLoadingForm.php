<?php

namespace Drupal\games_page_loading\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesPageLoadingForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.games_loading_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'games_page_loading.games_loading_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('games_config.games_loading_configuration');

    $form['games_loading_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['loading_message'] = array(
      '#type' => 'details',
      '#title' => $this->t('Loading Message Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_loading_configuration_tab'
    );

    $loading_message_content = $config->get('loading_message_content');
    $form['loading_message']['loading_message_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Loading Message Content'),
      '#description' => $this->t('The text to display on game page loading message.'),
      '#default_value' => $loading_message_content['value'],
      '#format' => $loading_message_content['format'],
      '#required' => TRUE,
    );

    $loading_error_message = $config->get('loading_error_message');
    $form['loading_message']['loading_error_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Loading Error Message Content'),
      '#description' => $this->t('The text to display on game page loading upon error.'),
      '#default_value' => $loading_error_message['value'],
      '#format' => $loading_error_message['format'],
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
      'loading_message_content',
      'loading_error_message',
    );

    foreach ($keys as $key) {
      $this->config('games_config.games_loading_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
