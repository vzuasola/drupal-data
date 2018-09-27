<?php
namespace Drupal\keno_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Keno Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "keno_config_form",
 *   route = {
 *     "title" = "Keno Configuration",
 *     "path" = "/admin/config/keno/keno_config",
 *   },
 *   menu = {
 *     "title" = "Keno Configuration",
 *     "description" = "Keno Configuration",
 *     "parent" = "keno_config.keno_config_list",
 *     "weight" = 1
 *   },
 * )
 */
class KenoConfigForm extends FormBase {
 /**
   * @inheritdoc
   */

  protected function getEditableConfigNames() {
    return ['keno_config.keno_configuration'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['keno_config_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];
    $this->lobbyTilesTab($form);
    $this->basicPageTab($form);
    $this->gameButtonTab($form);

    return $form;
  }

  private function lobbyTilesTab(&$form) {
    $form['lobby_tiles'] = [
      '#type' => 'details',
      '#title' => $this->t('Lobby Tiles'),
      '#collapsible' => true,
      '#group' => 'keno_config_form'
    ];

    $form['lobby_tiles']['lobby_tiles_alignment'] = [
      '#type' => 'select',
      '#title' => $this->t('Lobby Tiles Alignment'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $this->get('lobby_tiles_alignment'),
      '#required' => false,
      '#translatable' => true,
    ];

  }

  private function basicPageTab(&$form) {
    $form['basic_page'] = [
      '#type' => 'details',
      '#title' => $this->t('Basic page'),
      '#collapsible' => true,
      '#group' => 'keno_config_form'
    ];

    $form['basic_page']['basic_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Basic Page Background Image'),
      '#default_value' => $this->get('basic_page_background'),
      '#upload_location' => 'public://',
      '#description' =>  $this->t('Lobby tiles background'),
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $pageListSortUrl = Url::fromUri('internal:/admin/structure/sort-page-list', []);
    $pageListSortLink = Link::fromTextAndUrl(t('this link'), $pageListSortUrl);

    $form['basic_page']['basic_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Titles'),
      '#description' => $this->t('For sorting Basic Pages in a Page List go to '. $pageListSortLink->toString() . '.'),
      '#default_value' => $this->get('basic_page_title'),
      '#required' => false,
      '#translatable' => true,
    ];
  }

  private function gameButtonTab(&$form) {
    $form['games_button'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Button'),
      '#collapsible' => TRUE,
      '#group' => 'keno_config_form'
    ];

    $form['games_button']['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $this->get('play_text'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['games_button']['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('This text to display on game info link.'),
      '#default_value' => $this->get('game_info_text'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['games_button']['free_play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Free Play Text'),
      '#description' => $this->t('The text to display on Free Play Link.'),
      '#default_value' => $this->get('free_play_text'),
      '#required' => true,
      '#translatable' => true,
    ];

  }

}
