<?php

namespace Drupal\lucky_baby_all_games_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Lucky Baby All Games Configurations
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_all_games_config",
 *   route = {
 *     "title" = "Lucky Baby All Games Configurations",
 *     "path" = "/admin/config/all-games/settings",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby All Games Configurations",
 *     "description" = "Provides configuration for all games page.",
 *     "parent" = "lucky_baby_games_config.admin_settings",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyAllGamesConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.all_games_config'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('General Configurations'),
    ];

    $this->generalConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function generalConfig(array &$form) {
    $form['general'] = [
      '#type' => 'details',
      '#title' => t('General Configurations'),
      '#group' => 'advanced',
    ];

    $form['general']['all_games_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('all_games_page_title'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Header'),
      '#default_value' => $this->get('all_games_title'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_subtitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Subtitle'),
      '#default_value' => $this->get('all_games_subtitle'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_blurb'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Page blurb'),
      '#default_value' => $this->get('all_games_blurb'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_available_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Available Label'),
      '#default_value' => $this->get('all_games_available_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_view_all_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View All Label'),
      '#default_value' => $this->get('all_games_view_all_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_go_back_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Go Back Label'),
      '#default_value' => $this->get('all_games_go_back_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_show_more_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show More Label'),
      '#default_value' => $this->get('all_games_show_more_label'),
      '#translatable' => TRUE,
    ];
    
    $form['general']['all_games_show_less_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show Less Label'),
      '#default_value' => $this->get('all_games_show_less_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['all_games_searchbox_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Box Label'),
      '#default_value' => $this->get('all_games_searchbox_label'),
      '#translatable' => TRUE,
    ];
  }
}
