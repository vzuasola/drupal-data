<?php

namespace Drupal\jamboree_all_games_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Jamboree All Games Configurations
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_all_games_config",
 *   route = {
 *     "title" = "Jamboree All Games Configurations",
 *     "path" = "/admin/config/all-games/settings",
 *   },
 *   menu = {
 *     "title" = "Jamboree All Games Configurations",
 *     "description" = "Provides configuration for all games page.",
 *     "parent" = "jamboree_all_games_config.admin_settings",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeAllGamesConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.all_games_config'];
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

    $form['general']['all_games_show_more_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show More Label'),
      '#default_value' => $this->get('all_games_show_more_label'),
      '#translatable' => TRUE,
    ];
  }
}
