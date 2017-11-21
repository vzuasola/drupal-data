<?php

namespace Drupal\casino_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class GamesConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_games.games_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'casino_games.games_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_games.games_configuration');

    $form['games_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->gamePageheaderSection($form, $config);
    $this->gameCategorySection($form, $config);
    $this->gamsThumbnailSection($form, $config);
    $this->gamePageLightboxSection($form, $config);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $keys = array(
      'play_text',
      'play_for_fun_text',
      'game_info_text',
      'kebab_menu_text',
      'load_more_text',
      'load_more_disabled',
      'favorites_text',
      'recently_played_text',
      'freeplay_lightbox_title',
      'freeplay_lightbox_content',
      'html5_lightbox_title',
      'html5_lightbox_content',
      'disable_jackpot_ticker',
      'game_promotion_link',
      'game_promotion_link_target',
      'game_real_play_text',
      'game_real_play_disabled',
    );

    foreach ($keys as $key) {
      $this->config('casino_games.games_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

  private function gamePageheaderSection(&$form, $config) {
    $form['header_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Game Page Header Icons'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );
    $form['header_group']['game_promotion'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Promotion Icon'),
    );
    $form['header_group']['game_promotion']['game_promotion_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Promotions Link'),
      '#description' => $this->t('Add redirection to Centralized Promotions page'),
      '#default_value' => $config->get('game_promotion_link'),
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
      '#title' => $this->t('Promotions Link Target'),
      '#description' => $this->t('Select Target for the promotions link'),
      '#default_value' => $config->get('game_promotion_link_target'),
      '#required' => TRUE,
    );

    $form['header_group']['game_real_play'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Real Play Button'),
    );
    $form['header_group']['game_real_play']['game_real_play_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Real Play Button Label'),
      '#description' => $this->t('The text to display on real play button.'),
      '#default_value' => $config->get('game_real_play_text'),
      '#required' => TRUE,
    );
    $form['header_group']['game_real_play']['game_real_play_disabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Real Play Button'),
      '#description' => $this->t('If checked the real play button on pre-login state will not be displayed.'),
      '#default_value' => $config->get('game_real_play_disabled'),
      '#required' => FALSE,
    );
  }

  private function gameCategorySection(&$form, $config) {
    $form['category_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Games Category Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['category_group']['kebab_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Category Kebab Text'),
      '#description' => $this->t('The text to display on category kebab menu.'),
      '#default_value' => $config->get('kebab_menu_text'),
      '#required' => TRUE,
    );

    $form['category_group']['load_more_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Load More Text'),
      '#description' => $this->t('The text to display on load more button.'),
      '#default_value' => $config->get('load_more_text'),
      '#required' => TRUE,
    );

    $form['category_group']['load_more_disabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Load More'),
      '#description' => $this->t('If checked all games will be shown at once.'),
      '#default_value' => $config->get('load_more_disabled'),
      '#required' => FALSE,
    );

    $form['category_group']['special_categories'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Special Categories'),
    );
    $form['category_group']['special_categories']['favorites_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Favorites Tab Text'),
      '#description' => $this->t('The text to display for the favorites category.'),
      '#default_value' => $config->get('favorites_text'),
      '#required' => TRUE,
    );
    $form['category_group']['special_categories']['recently_played_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Recently Played Text'),
      '#description' => $this->t('The text to display for the recently played category.'),
      '#default_value' => $config->get('recently_played_text'),
      '#required' => TRUE,
    );
  }

  private function gamsThumbnailSection(&$form, $config) {
    $form['thumbnail_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Game Thumbnail Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab',
    );

    $form['thumbnail_group']['disable_jackpot_ticker'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Game Thumbnail Jackpot Ticker'),
      '#default_value' => $config->get('disable_jackpot_ticker'),
      '#description' => $this->t('If checked all jackpot ticker on game thumbnails will not be displayed.')
    );

    $form['thumbnail_group']['play_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $config->get('play_text'),
      '#required' => TRUE,
    );

    $form['thumbnail_group']['play_for_fun_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Play For Fun Link Text'),
      '#description' => $this->t('The text to display on play for fun link.'),
      '#default_value' => $config->get('play_for_fun_text'),
      '#required' => TRUE,
    );

    $form['thumbnail_group']['game_info_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('The text to display on game info link.'),
      '#default_value' => $config->get('game_info_text'),
      '#required' => TRUE,
    );
  }

  private function gamePageLightboxSection(&$form, $config) {
    $form['lightbox_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Game Page Lightbox'),
      '#collapsible' => TRUE,
      '#group' => 'games_configuration_tab'
    );

    $freePlayLightboxGroupTitle = $this->t('Direct access free play on Post login (Lightbox)');
    $form['lightbox_group']['freeplay'] = array(
        '#type' => 'details',
        '#title' => $freePlayLightboxGroupTitle,
        '#open' => TRUE,
        '#description' => 'This lightbox will appear when a player access free play mode on post-login state.'
    );
    $form['lightbox_group']['freeplay']['freeplay_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $config->get('freeplay_lightbox_title'),
      '#required' => TRUE,
    );
    $freePlayLightboxContent = $config->get('freeplay_lightbox_content');
    $form['lightbox_group']['freeplay']['freeplay_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $freePlayLightboxContent['value'],
      '#format' => $freePlayLightboxContent['format'],
      '#required' => TRUE,
    );

    $html5LightboxGroupTitle = $this->t('HTML5 Alert (Lightbox)');
    $form['lightbox_group']['html5'] = array(
        '#type' => 'details',
        '#title' => $html5LightboxGroupTitle,
        '#open' => TRUE,
        '#description' => '<p>This lightbox will appear if player access an html5 game '
                        . 'on a browser that do not support html5.</p>'
    );
    $form['lightbox_group']['html5']['html5_lightbox_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The text that will be displayed as title of the lightbox.'),
      '#default_value' => $config->get('html5_lightbox_title'),
      '#required' => TRUE,
    );
    $html5LightboxContent = $config->get('html5_lightbox_content');
    $form['lightbox_group']['html5']['html5_lightbox_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as content of the lightbox.'),
      '#default_value' => $html5LightboxContent['value'],
      '#format' => $html5LightboxContent['format'],
      '#required' => TRUE,
    );
  }
}
