<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_games",
 *   route = {
 *     "title" = "Game Page Configuration",
 *     "path" = "/admin/config/jamboree/game_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Page Configuration",
 *     "description" = "Provides game page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 40
 *   },
 * )
 */
class JamboreeGamesConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.games_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Game Page Configuration'),
    ];

    $this->sectionGames($form);
    $this->sectionPagination($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionGames(array &$form) {
    $form['games'] = [
      '#type' => 'details',
      '#title' => t('General Config'),
      '#group' => 'advanced',
    ];

    $d = $this->get('no_result_msg');

    $form['games']['no_result_msg'] = [
      '#type' => 'text_format',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }

  private function sectionPagination(array &$form) {
    $form['pagination'] = [
      '#type' => 'details',
      '#title' => t('Pagination'),
      '#group' => 'advanced',
    ];

    $form['pagination']['items_per_page'] = [
      '#type' => 'textfield',
      '#title' => t('Number of items per page'),
      '#default_value' => $this->get('items_per_page') ?? 16,
      '#translatable' => TRUE,
    ];

    $form['pagination']['previous_page_label'] = [
      '#type' => 'textfield',
      '#title' => t('Previous Button Label'),
      '#default_value' => $this->get('previous_page_label') ?? "&#8810;",
      '#translatable' => TRUE,
    ];

    $form['pagination']['next_page_label'] = [
      '#type' => 'textfield',
      '#title' => t('Next Button Label'),
      '#default_value' => $this->get('next_page_label') ?? "&#8811;",
      '#translatable' => TRUE,
    ];
  }
}
