<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\file\Entity\File;

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

    $config = $this->config('jamboree_config.games_page_configuration');

    $form['games']['live_games_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Live Games Page Banner - EN')
    ];

    $form['games']['live_games_banner_en']['live_games_banner_image_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Live Games Page Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('live_games_banner_image_en'),
    ];

    $form['games']['live_games_banner_en']['banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('banner_alt_text_en'),
      '#translatable' => TRUE,
    ];

    $form['games']['live_games_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Live Games Page Banner - JA')
    ];

    $form['games']['live_games_banner_ja']['live_games_banner_image_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Live Games Page Banner'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('live_games_banner_image_ja'),
    ];

   $form['games']['live_games_banner_ja']['banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('banner_alt_text_ja'),
      '#translatable' => TRUE,
    ];

    $form['games']['live_games_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Live Games Page Description'),
      '#default_value' => $this->get('live_games_description'),
      '#translatable' => TRUE,
    ];

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

    $e = $this->get('mixed_game_lobby_all_banner');

    $form['mixed_game_lobby_all']['mixed_game_lobby_all_banner'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Top Block Banner'),
      '#default_value' => $e['value'],
      '#format' => $e['format'],
      '#translatable' => TRUE,
    ];

    $d = $this->get('mixed_game_lobby_all_desc');

    $form['mixed_game_lobby_all']['mixed_game_lobby_all_desc'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }

 /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'live_games_banner_image_en',
      'live_games_banner_image_ja',
      ];

    foreach ($keys as $key) {
      if ($key == 'live_games_banner_image_en' || $key == 'live_games_banner_image_ja') {
        $fid = $form_state->getValue($key);
        if ($fid && isset($fid[0])) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();
          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'jamboree-casino', 'image', $fid[0]);

          $this->config('jamboree_config.games_page_configuration')->set(
            $key . '_url',
            file_create_url($file->getFileUri())
            )->save();
        }
      }
      $this->config('jamboree_config.games_page_configuration')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
