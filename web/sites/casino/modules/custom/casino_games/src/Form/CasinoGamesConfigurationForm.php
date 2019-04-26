<?php

namespace Drupal\casino_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Casino custom config form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "casino_config_form",
 *   route = {
 *     "title" = "Casino Custom Configuration",
 *     "path" = "/admin/games/config",
 *   },
 *   menu = {
 *     "title" = "Casino Custom Configuration",
 *     "description" = "Configure custom casino games configuration",
 *     "parent" = "casino_games.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class CasinoGamesConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_games.games_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_configuration_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->gamePageheaderSection($form);
    $this->gameCategorySection($form);
    $this->gamesThumbnailSection($form);
    $this->gamePageLightboxSection($form);
    $this->gameFilterSection($form);
    $this->gameDrawerSection($form);

    return $form;
  }

  private function gamePageheaderSection(&$form) {
    $form['header_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Page Header Icons'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    ];
    $form['header_group']['game_promotion'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Promotion Icon'),
    ];
    $form['header_group']['game_promotion']['game_promotion_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Link'),
      '#description' => $this->t('Add redirection to Centralized Promotions page'),
      '#default_value' => $this->get('game_promotion_link'),
      '#required' => TRUE,
      '#prefix' => '<p>Configure the promotion icon link and target window.</p>',
    ];
    $form['header_group']['game_promotion']['game_promotion_link_target'] = [
      '#type' => 'select',
      '#options' => [
          '_blank' => 'New Tab',
          '_self' => 'Same Window',
          'window' => 'New Window'
      ],
      '#title' => $this->t('Promotions Link Target'),
      '#description' => $this->t('Select Target for the promotions link'),
      '#default_value' => $this->get('game_promotion_link_target'),
      '#required' => TRUE,
    ];

    $form['header_group']['game_real_play'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Real Play Button'),
    ];
    $form['header_group']['game_real_play']['game_real_play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Real Play Button Label'),
      '#description' => $this->t('The text to display on real play button.'),
      '#default_value' => $this->get('game_real_play_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
    $form['header_group']['game_real_play']['game_real_play_disabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Real Play Button'),
      '#description' => $this->t('If checked the real play button on pre-login state will not be displayed.'),
      '#default_value' => $this->get('game_real_play_disabled'),
      '#required' => FALSE,
    ];
  }

  private function gameCategorySection(&$form) {
    $form['category_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Games Category Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    ];

    $form['category_group']['kebab_menu_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Category Kebab Text'),
      '#description' => $this->t('The text to display on category kebab menu.'),
      '#default_value' => $this->get('kebab_menu_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['category_group']['special_categories'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Special Categories'),
    ];
    $form['category_group']['special_categories']['favorites_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Favorites Tab Text'),
      '#description' => $this->t('The text to display for the favorites category.'),
      '#default_value' => $this->get('favorites_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
    $form['category_group']['special_categories']['recently_played_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Recently Played Text'),
      '#description' => $this->t('The text to display for the recently played category.'),
      '#default_value' => $this->get('recently_played_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
  }

  private function gamesThumbnailSection(&$form) {
    $form['thumbnail_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Thumbnail Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    ];

    $form['thumbnail_group']['disable_jackpot_ticker'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Game Thumbnail Jackpot Ticker'),
      '#default_value' => $this->get('disable_jackpot_ticker'),
      '#description' => $this->t('If checked all jackpot ticker on game thumbnails will not be displayed.')
    ];

    $form['thumbnail_group']['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $this->get('play_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['thumbnail_group']['play_for_fun_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play For Fun Link Text'),
      '#description' => $this->t('The text to display on play for fun link.'),
      '#default_value' => $this->get('play_for_fun_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['thumbnail_group']['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $this->get('game_info_text'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
  }

  private function gamePageLightboxSection(&$form) {
    $form['lightbox_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Page Lightbox'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    ];

    $freePlayLightboxGroupTitle = $this->t('Direct access free play on Post login (Lightbox)');
    $form['lightbox_group']['freeplay'] = [
        '#type' => 'details',
        '#title' => $freePlayLightboxGroupTitle,
        '#open' => TRUE,
        '#description' => 'This lightbox will appear when a player access free play mode on post-login state.'
    ];
    $form['lightbox_group']['freeplay']['freeplay_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('freeplay_lightbox_title'),
      '#required' => TRUE,
      '#translatable' => TRUE

    ];
    $freePlayLightboxContent = $this->get('freeplay_lightbox_content');
    $form['lightbox_group']['freeplay']['freeplay_lightbox_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $freePlayLightboxContent['value'],
      '#format' => $freePlayLightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $html5LightboxGroupTitle = $this->t('HTML5 Alert (Lightbox)');
    $form['lightbox_group']['html5'] = [
        '#type' => 'details',
        '#title' => $html5LightboxGroupTitle,
        '#open' => TRUE,
        '#description' => '<p>This lightbox will appear if player access an html5 game '
                        . 'on a browser that do not support html5.</p>'
    ];
    $form['lightbox_group']['html5']['html5_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('html5_lightbox_title'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
    $html5LightboxContent = $this->get('html5_lightbox_content');
    $form['lightbox_group']['html5']['html5_lightbox_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $html5LightboxContent['value'],
      '#format' => $html5LightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
    $pasLightboxGroupTitle = $this->t('[deprecated] PAS Error (Lightbox)');
    $form['lightbox_group']['pas'] = [
        '#type' => 'details',
        '#title' => $pasLightboxGroupTitle,
        '#open' => false,
        '#description' => '<p>This lightbox will appear if pas authentication failed on game launch.</p>'
    ];
    $form['lightbox_group']['pas']['pas_error_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('pas_error_lightbox_title'),
      '#required' => FALSE,
      '#translatable' => TRUE
    ];
    $pasErrorLightboxContent = $this->get('pas_error_lightbox_content');
    $form['lightbox_group']['pas']['pas_error_lightbox_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $pasErrorLightboxContent['value'],
      '#format' => $pasErrorLightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
  }

  private function gameFilterSection(&$form) {
    $form['filter_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Filter'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    ];

    $form['filter_group']['filter_icon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Filter Icon Text'),
      '#default_value' => $this->get('filter_icon'),
      '#description' => $this->t('The test to display in the front'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['filter_group']['filter_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Filter Lightbox Header Text'),
      '#description' => $this->t('The text to display on the header of lightbox'),
      '#default_value' => $this->get('filter_header'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['filter_group']['filter_submit'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Filter Lightbox Submit Botton Text'),
      '#description' => $this->t('The text to display on the submit botton of filter lightbox'),
      '#default_value' => $this->get('filter_submit'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];

    $form['filter_group']['filter_clear'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Filter Lightbox Clear Botton Text'),
      '#description' => $this->t('The text to display on clear botton of filter lightbox'),
      '#default_value' => $this->get('filter_clear'),
      '#required' => TRUE,
      '#translatable' => TRUE
    ];
  }

  private function gameDrawerSection(&$form) {
    $form['drawer'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Drawer'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    ];

    $form['drawer']['drawer_switch'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Game Drawer'),
      '#description' => $this->t('Enable Game Drawer feature'),
      '#default_value' => $this->get('drawer_switch'),
      '#required' => FALSE,
      '#translatable' => TRUE
    ];
  }
}
