<?php

namespace Drupal\tournament_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ClassTournamentApiSettingsForm.
 *
 * @ingrouptournament_api
 */
class TournamentApiSettingsForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['webcomposer_config.tournament_api_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId()
  {
    return 'tournament_api_settings';
  }

  /**
   * Defines the settings form for Tournament Api entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('webcomposer_config.tournament_api_configuration');

    $form['tournament_api_settings']['#markup'] = 'Settings form for Tournament API entities. Manage field settings here.';
    $form['tournament_api_settings']['api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API URL for Session Sharing'),
      '#default_value' => $config->get('api_url'),
      '#translatable' => FALSE,
      '#required' => TRUE,
    ];
    $form['tournament_api_settings']['api_casino'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Casino for Session Sharing'),
      '#default_value' => $config->get('api_casino'),
      '#translatable' => FALSE,
      '#required' => TRUE,
    ];

    $form['tournament_api_settings']['banner_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Banner Display Configuration'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];


    $form['tournament_api_settings']['banner_settings']['enable_collapsible_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Collapsible Tournament Api.'),
      '#default_value' => $config->get('enable_collapsible_api'),
    ];

    $form['tournament_api_settings']['banner_settings']['api_pager_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Pager Position'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('api_pager_position') ? $config->get('api_pager_position') : 'center',
    ];

    $form['tournament_api_settings']['banner_settings']['enable_transition_api'] = [
      '#type' => 'select',
      '#title' => $this->t('Blurb Animation'),
      '#options' => [
        't-none' => 'none',
        't-1s' => '.5s',
        't-2s' => '1s',
        't-3s' => '2s',
      ],
      '#default_value' => $config->get('enable_transition_api') ? $config->get('enable_transition_api') : 'none',
    ];

    $form['tournament_api_settings']['banner_settings']['button_learn_more'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Text for Learn More'),
      '#default_value' => $config->get('button_learn_more'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_api_settings']['banner_settings']['button_join'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Text for Join'),
      '#default_value' => $config->get('button_join'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_api_settings']['notification'] = [
      '#type' => 'details',
      '#title' => $this->t('Notification Prompt Configuration'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['tournament_api_settings']['notification']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title of Prompt Lighbox'),
      '#default_value' => $config->get('title'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $d = $config->get('message');
    $form['tournament_api_settings']['notification']['message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Message for Prompt Lightbox'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_api_settings']['notification']['button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Title'),
      '#default_value' => $config->get('button_text'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $keys = [
      'enable_transition_api',
      'api_pager_position',
      'enable_collapsible_api',
      'title',
      'message',
      'button_text',
      'api_url',
      'api_casino',
      'button_learn_more',
      'button_join'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.tournament_api_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}
