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

    $form['games']['arcade_games_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Arcade Page Title'),
      '#default_value' => $this->get('arcade_games_title'),
      '#translatable' => TRUE,
    ];

    $form['games']['arcade_games_search'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Arcade Page Search'),
      '#default_value' => $this->get('arcade_games_search'),
      '#description' => $this->t('Adds placeholder to Arcade page searchbox.'),
      '#translatable' => TRUE,
    ];

    $form['games']['live_games_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Games Page Title'),
      '#default_value' => $this->get('live_games_title'),
      '#translatable' => TRUE,
    ];

    $form['games']['live_games_search'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Games Page Search'),
      '#default_value' => $this->get('live_games_search'),
      '#description' => $this->t('Adds placeholder to Live Games page searchbox.'),
      '#translatable' => TRUE,
    ];

    $config = $this->config('zipang_config.games_page_configuration');

    $form['games']['live_games_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Live Games Page Banner - EN'),
    ];

    $form['games']['live_games_banner_en']['file_image_live_banner_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Live Games Page Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('file_image_live_banner_en'),
    ];

    $form['games']['live_games_banner_en']['banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('banner_alt_text_en'),
    ];

    $form['games']['live_games_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Live Games Page Banner - JA'),
    ];

    $form['games']['live_games_banner_ja']['file_image_live_banner_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Live Games Page Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('file_image_live_banner_ja'),
    ];

    $form['games']['live_games_banner_ja']['banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('banner_alt_text_ja'),
    ];

    $form['games']['live_games_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Live Games Page Description'),
      '#default_value' => $this->get('live_games_description'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('no_result_msg');

    $form['games']['no_result_msg'] = [
      '#type' => 'text_format',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['games']['category_views'] = [
      '#type' => 'fieldset',
      '#title' => t('Casino Page Game Category '),
    ];

    $form['games']['category_views']['enable_views_v2'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Casino Page Game Category V2 enable - (✓)enable | (✕)disable'),
      '#default_value' => $this->get('enable_views_v2'),
      '#translatable' => TRUE,
    ];

    $form['games']['game_list_views'] = [
      '#type' => 'fieldset',
      '#title' => t('Game List Views'),
    ];

    $form['games']['game_list_views']['enable_views_trimmed'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Switch Game List Views to Trimmed Version - (✓)enable | (✕)disable'),
      '#default_value' => $this->get('enable_views_trimmed'),
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

    $form['mixed_game_lobby_all']['mixed_game_lobby_test'] = [
      '#type' => 'textfield',
      '#title' => t('Header title test'),
      '#default_value' => $this->get('mixed_game_lobby_test') ?? "ALL",
      '#translatable' => TRUE,
    ];

    $e = $this->get('mixed_game_lobby_all_banner');

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
      '#upload_location' => 'public://',
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
