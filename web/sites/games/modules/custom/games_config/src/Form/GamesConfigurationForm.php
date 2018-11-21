<?php

namespace Drupal\games_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games custom config form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_config",
 *   route = {
 *     "title" = "Games Custom Configuration",
 *     "path" = "/admin/games/config",
 *   },
 *   menu = {
 *     "title" = "Games Custom Configuration",
 *     "description" = "Configure the Games",
 *     "parent" = "games_config.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class GamesConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.games_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->gamePageheaderSection($form);
    $this->gameCategorySection($form);
    $this->gamsThumbnailSection($form);
    $this->gamePageLightboxSection($form);
    $this->gameFilterSection($form);
    $this->gameDrawerSection($form);

    return $form;
  }

  private function gamePageheaderSection(&$form) {
    $form['header_group'] = array(
      '#type' => 'details',
      '#title' => t('Game Page Header Icons'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );
    $form['header_group']['game_promotion'] = array(
      '#type' => 'fieldset',
      '#title' => t('Promotion Icon'),
    );
    $form['header_group']['game_promotion']['game_promotion_link'] = array(
      '#type' => 'textfield',
      '#title' => t('Promotions Link'),
      '#description' => t('Add redirection to Centralized Promotions page'),
      '#default_value' => $this->get('game_promotion_link'),
      '#required' => TRUE,
      '#prefix' => '<p>Configure the promotion icon link and target window.</p>',
    );
    $form['header_group']['game_promotion']['game_promotion_link_target'] = array(
      '#type' => 'select',
      '#options' => [
          '_blank' => 'New Tab',
          '_self' => 'Same Window',
          'window' => 'New Window'
      ],
      '#title' => t('Promotions Link Target'),
      '#description' => t('Select Target for the promotions link'),
      '#default_value' => $this->get('game_promotion_link_target'),
      '#required' => TRUE,
    );

    $form['header_group']['game_real_play'] = array(
      '#type' => 'fieldset',
      '#title' => t('Real Play Button'),
    );
    $form['header_group']['game_real_play']['game_real_play_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Real Play Button Label'),
      '#description' => t('The text to display on real play button.'),
      '#default_value' => $this->get('game_real_play_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $form['header_group']['game_real_play']['game_real_play_disabled'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Real Play Button'),
      '#description' => t('If checked the real play button on pre-login state will not be displayed.'),
      '#default_value' => $this->get('game_real_play_disabled'),
      '#required' => FALSE,
    );
  }

  private function gameCategorySection(&$form) {
    $form['category_group'] = array(
      '#type' => 'details',
      '#title' => t('Games Category Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['category_group']['kebab_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Category Kebab Text'),
      '#description' => t('The text to display on category kebab menu.'),
      '#default_value' => $this->get('kebab_menu_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['category_group']['special_categories'] = array(
      '#type' => 'fieldset',
      '#title' => t('Special Categories'),
    );
    $form['category_group']['special_categories']['home_categories_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Home Categories Text'),
      '#description' => t('The text to display for the home category.'),
      '#default_value' => $this->get('home_categories_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $form['category_group']['special_categories']['favorites_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Favorites Tab Text'),
      '#description' => t('The text to display for the favorites category.'),
      '#default_value' => $this->get('favorites_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $form['category_group']['special_categories']['recently_played_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Recently Played Text'),
      '#description' => t('The text to display for the recently played category.'),
      '#default_value' => $this->get('recently_played_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $form['category_group']['special_categories']['allgames_categories_text'] = array(
      '#type' => 'textfield',
      '#title' => t('All Games Categories Text'),
      '#description' => t('The text to display for the all games category. <i>Leave blank to not show.</i>'),
      '#default_value' => $this->get('allgames_categories_text'),
      '#translatable' => true,
    );
  }

  private function gamsThumbnailSection(&$form) {
    $form['thumbnail_group'] = array(
      '#type' => 'details',
      '#title' => t('Game Thumbnail Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['thumbnail_group']['disable_jackpot_ticker'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Game Thumbnail Jackpot Ticker'),
      '#default_value' => $this->get('disable_jackpot_ticker'),
      '#description' => t('If checked all jackpot ticker on game thumbnails will not be displayed.')
    );

    $form['thumbnail_group']['play_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Play Now Button Text'),
      '#description' => t('The text to display on play button.'),
      '#default_value' => $this->get('play_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['thumbnail_group']['play_for_fun_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Play For Fun Link Text'),
      '#description' => t('The text to display on play for fun link.'),
      '#default_value' => $this->get('play_for_fun_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['thumbnail_group']['game_info_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Game Info Link Text'),
      '#description' => t('The text to display on game info link.'),
      '#default_value' => $this->get('game_info_text'),
      '#required' => TRUE,
      '#translatable' => true,
    );
  }

  private function gamePageLightboxSection(&$form) {
    $form['lightbox_group'] = array(
      '#type' => 'details',
      '#title' => t('Game Page Lightbox'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );

    $freePlayLightboxGroupTitle = t('Direct access free play on Post login (Lightbox)');
    $form['lightbox_group']['freeplay'] = array(
        '#type' => 'details',
        '#title' => $freePlayLightboxGroupTitle,
        '#open' => TRUE,
        '#description' => 'This lightbox will appear when a player access free play mode on post-login state.'
    );
    $form['lightbox_group']['freeplay']['freeplay_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#description' => t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('freeplay_lightbox_title'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $freePlayLightboxContent = $this->get('freeplay_lightbox_content');
    $form['lightbox_group']['freeplay']['freeplay_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => t('Content'),
      '#description' => t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $freePlayLightboxContent['value'],
      '#format' => $freePlayLightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => true,
    );

    $html5LightboxGroupTitle = t('HTML5 Alert (Lightbox)');
    $form['lightbox_group']['html5'] = array(
        '#type' => 'details',
        '#title' => $html5LightboxGroupTitle,
        '#open' => TRUE,
        '#description' => '<p>This lightbox will appear if player access an html5 game '
                        . 'on a browser that do not support html5.</p>'
    );
    $form['lightbox_group']['html5']['html5_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#description' => t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('html5_lightbox_title'),
      '#required' => TRUE,
      '#translatable' => true,
    );
    $html5LightboxContent = $this->get('html5_lightbox_content');
    $form['lightbox_group']['html5']['html5_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => t('Content'),
      '#description' => t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $html5LightboxContent['value'],
      '#format' => $html5LightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => true,
    );
    $pasLightboxGroupTitle = t('PAS Error (Lightbox)');
    $form['lightbox_group']['pas'] = array(
        '#type' => 'details',
        '#title' => $pasLightboxGroupTitle,
        '#open' => TRUE,
        '#description' => '<p>This lightbox will appear if pas authentication failed on game launch.</p>'
    );
    $form['lightbox_group']['pas']['pas_error_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#description' => t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $this->get('pas_error_lightbox_title'),
      '#required' => FALSE,
      '#translatable' => true,
    );
    $pasErrorLightboxContent = $this->get('pas_error_lightbox_content');
    $form['lightbox_group']['pas']['pas_error_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => t('Content'),
      '#description' => t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $pasErrorLightboxContent['value'],
      '#format' => $pasErrorLightboxContent['format'],
      '#required' => TRUE,
      '#translatable' => true,
    );
  }

  private function gameFilterSection(&$form) {
    $form['filter_group'] = array(
      '#type' => 'details',
      '#title' => t('Game Filter'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['filter_group']['deprecated'] = array(
      '#type' => 'details',
      '#title' => $this->t('Deprecated'),
      '#description' => $this->t('These are deprecated fields to support old products.'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    );

    $form['filter_group']['deprecated']['filter_icon'] = array(
      '#type' => 'textfield',
      '#title' => t('Game Filter Icon Text'),
      '#default_value' => $this->get('filter_icon'),
      '#description' => t('The test to display in the front'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['filter_group']['deprecated']['filter_header'] = array(
      '#type' => 'textfield',
      '#title' => t('Game Filter Lightbox Header Text'),
      '#description' => t('The text to display on the header of lightbox'),
      '#default_value' => $this->get('filter_header'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['filter_group']['deprecated']['filter_submit'] = array(
      '#type' => 'textfield',
      '#title' => t('Game Filter Lightbox Submit Botton Text'),
      '#description' => t('The text to display on the submit botton of filter lightbox'),
      '#default_value' => $this->get('filter_submit'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['filter_group']['deprecated']['filter_clear'] = array(
      '#type' => 'textfield',
      '#title' => t('Game Filter Lightbox Clear Botton Text'),
      '#description' => t('The text to display on clear botton of filter lightbox'),
      '#default_value' => $this->get('filter_clear'),
      '#required' => TRUE,
      '#translatable' => true,
    );

    $form['filter_group']['userdata_header'] = array(
      '#type' => 'textfield',
      '#title' => t('Userdata Header'),
      '#default_value' => $this->get('userdata_header'),
      '#description' => t('Header to be used for userdata filters (Recently Played, Favorites etc.)'),
      '#required' => TRUE,
      '#translatable' => true,
    );
  }

  private function gameDrawerSection(&$form) {
    $form['drawer'] = array(
      '#type' => 'details',
      '#title' => t('Game Drawer'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['drawer']['drawer_switch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable Game Drawer'),
      '#description' => t('Enable Game Drawer feature'),
      '#default_value' => $this->get('drawer_switch'),
      '#required' => FALSE,
      '#translatable' => true,
    );
  }
}
