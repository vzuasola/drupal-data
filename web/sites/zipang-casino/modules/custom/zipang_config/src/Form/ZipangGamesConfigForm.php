<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\file\Entity\File;


/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_games",
 *   route = {
 *     "title" = "Game Page Configuration",
 *     "path" = "/admin/config/zipang/game_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Page Configuration",
 *     "description" = "Provides game page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 40
 *   },
 * )
 */
class ZipangGamesConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.games_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Game Page Configuration'),
    ];

    $this->sectionGames($form);
    $this->sectionPagination($form);
    $this->sectionMixedGameLobbyAllConfig($form);

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

    $form['sub_category_label'] = [
      '#type' => 'details',
      '#title' => t('Sub Category Label Configuration'),
      '#group' => 'advanced',
    ];

    $form['sub_category_label']['subcategory_all_label'] = [
      '#type' => 'textfield',
      '#title' => t('Subcategory All Label'),
      '#default_value' => $this->get('subcategory_all_label') ?? "ALL",
      '#translatable' => TRUE,
    ];

    $form['more_category_label'] = [
      '#type' => 'details',
      '#title' => t('More Category Label Configuration'),
      '#group' => 'advanced',
    ];

    $form['more_category_label']['more_label'] = [
      '#type' => 'textfield',
      '#title' => t('More Label'),
      '#default_value' => $this->get('more_label') ?? "More",
      '#translatable' => TRUE,
    ];
  }

  private function sectionMixedGameLobbyAllConfig(array &$form) {
    $form['mixed_game_lobby_all'] = [
      '#type' => 'details',
      '#title' => t('Mixed Game Lobby ALL Config'),
      '#group' => 'advanced',
    ];

    $form['mixed_game_lobby_all']['mixed_game_lobby_all_title'] = [
      '#type' => 'textfield',
      '#title' => t('Header title label'),
      '#default_value' => $this->get('mixed_game_lobby_all_title') ?? "ALL",
      '#translatable' => TRUE,
    ];

    $form['mixed_game_lobby_all']['mixed_game_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Top Block Banner - EN')
    ];

    $form['mixed_game_lobby_all']['mixed_game_banner_en']['file_image_mixed_game_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Top Block Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_mixed_game_en'),
    ];

    $form['mixed_game_lobby_all']['mixed_game_banner_en']['mixed_game_banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('mixed_game_banner_alt_text_en'),
    ];

    $form['mixed_game_lobby_all']['mixed_game_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Top Block Banner - JA')
    ];

    $form['mixed_game_lobby_all']['mixed_game_banner_ja']['file_image_mixed_game_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Top Block Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_mixed_game_ja'),
    ];

   $form['mixed_game_lobby_all']['mixed_game_banner_ja']['mixed_game_banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('mixed_game_banner_alt_text_ja'),
    ];


    $d = $this->get('mixed_game_lobby_all_desc');

    $form['mixed_game_lobby_all']['mixed_game_lobby_all_desc'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description (PRE-LOGIN)'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $d = $this->get('mixed_game_lobby_all_desc_post');

    $form['mixed_game_lobby_all']['mixed_game_lobby_all_desc_post'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description (POST-LOGIN)'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }
}
