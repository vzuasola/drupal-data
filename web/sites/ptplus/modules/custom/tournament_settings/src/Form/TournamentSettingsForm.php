<?php

namespace Drupal\tournament_settings\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "tournament_settings",
 *   route = {
 *     "title" = "Tournament Configuration",
 *     "path" = "/admin/config/tournament/configuration",
 *   },
 *   menu = {
 *     "title" = "Tournament Configuration",
 *     "description" = "Provides configuration for PT+ Tournaments",
 *     "parent" = "tournament_api.list",
 *   },
 * )
 */
class TournamentSettingsForm extends FormBase {

  protected function getEditableConfigNames() {
    return ['webcomposer_config.tournament_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
        $form['tournament_settings']['#markup'] = 'Settings form for Tournament API entities. Manage field settings here.';
        $form['tournament_settings']['api_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('API URL for Session Sharing'),
        '#default_value' => $this->get('api_url'),
        '#translatable' => FALSE,
        '#required' => TRUE,
        ];
        $form['tournament_settings']['api_casino'] = [
        '#type' => 'textfield',
        '#title' => $this->t('API Casino for Session Sharing'),
        '#default_value' => $this->get('api_casino'),
        '#translatable' => FALSE,
        '#required' => TRUE,
        ];

        $form['tournament_settings']['banner_settings'] = [
        '#type' => 'details',
        '#title' => $this->t('Banner Display Configuration'),
        '#collapsible' => TRUE,
        '#open' => FALSE,
        ];

        $form['tournament_settings']['banner_settings']['enable_transition_api'] = [
        '#type' => 'select',
        '#title' => $this->t('Blurb Animation'),
        '#options' => [
            't-none' => 'none',
            't-1s' => '.5s',
            't-2s' => '1s',
            't-3s' => '2s',
        ],
        '#default_value' => $this->get('enable_transition_api') ? $this->get('enable_transition_api') : 'none',
        ];

        $form['tournament_settings']['banner_settings']['button_learn_more'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button Text for Learn More'),
        '#default_value' => $this->get('button_learn_more'),
        '#translatable' => TRUE,
        '#required' => TRUE,
        ];

        $form['tournament_settings']['banner_settings']['button_join'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button Text for Join'),
        '#default_value' => $this->get('button_join'),
        '#translatable' => TRUE,
        '#required' => TRUE,
        ];

        $form['tournament_settings']['notification'] = [
        '#type' => 'details',
        '#title' => $this->t('Notification Prompt Configuration'),
        '#collapsible' => TRUE,
        '#open' => FALSE,
        ];

        $form['tournament_settings']['notification']['title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title of Prompt Lighbox'),
        '#default_value' => $this->get('title'),
        '#translatable' => TRUE,
        '#required' => TRUE,
        ];

        $d = $this->get('message');
        $form['tournament_settings']['notification']['message'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Message for Prompt Lightbox'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
        '#required' => TRUE,
        ];

        $form['tournament_settings']['notification']['button_text'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button Title'),
        '#default_value' => $this->get('button_text'),
        '#translatable' => TRUE,
        '#required' => TRUE,
        ];

    $form['tournament_settings']['general_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Board Configuration'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['tournament_settings']['general_settings']['daily_mission_api'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Daily Missions API Url'),
      '#default_value' => $this->get('daily_mission_api') ?? 'https://ptplus-b.hotspin88.com/api/external/activity/dailyMission',
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_settings']['general_settings']['leaderboards_api'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Leaderboards API Url'),
      '#default_value' => $this->get('leaderboards_api') ?? 'https://ptplus-b.hotspin88.com/api/external/activity/leaderboard/list',
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_settings']['general_settings']['key_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Entity Key Mapping'),
      '#default_value' => $this->get('key_mapping'),
      '#rows' => 7,
      '#cols' => 2,
      '#description' => $this->t('Format of data in field (entity_name | entity_key)'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_settings']['general_settings']['default_key_name_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Entity Name Mapping'),
      '#default_value' => $this->get('default_key_name_mapping'),
      '#rows' => 7,
      '#cols' => 2,
      '#description' => $this->t('Format of data in field (Language code | currency)'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['tournament_settings']['general_settings']['api_language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language API Mapping'),
      '#default_value' => $this->get('api_language_mapping'),
      '#rows' => 7,
      '#cols' => 2,
      '#description' => $this->t('Format of data in field (Language code | API lang Code)'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];


    return $form;
  }

}
