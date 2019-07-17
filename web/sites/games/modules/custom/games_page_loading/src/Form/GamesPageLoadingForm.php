<?php

namespace Drupal\games_page_loading\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Game page loading form
 *
 * @WebcomposerConfigPlugin(
 *   id = "game_page_loading_config_form",
 *   route = {
 *     "title" = "Games Page Loading Configuration ",
 *     "path" = "/admin/games/page-loading-config",
 *   },
 *   menu = {
 *     "title" = "Games Page Loading Configuration ",
 *     "description" = "Configure page loading configuration",
 *     "parent" = "games_config.admin_settings",
 *     "weight" = 11
 *   },
 * )
 */
class GamesPageLoadingForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.games_loading_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['games_loading_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Settings'),
    );

    $form['loading_message'] = array(
      '#type' => 'details',
      '#title' => $this->t('Loading Message Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_loading_configuration_tab'
    );

    $loading_message_content = $this->get('loading_message_content');
    $form['loading_message']['loading_message_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Loading Message Content'),
      '#description' => $this->t('The text to display on game page loading message.'),
      '#default_value' => $loading_message_content['value'],
      '#format' => $loading_message_content['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    $loading_error_message = $this->get('loading_error_message');
    $form['loading_message']['loading_error_message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Loading Error Message Content'),
      '#description' => $this->t('The text to display on game page loading upon error.'),
      '#default_value' => $loading_error_message['value'],
      '#format' => $loading_error_message['format'],
      '#required' => TRUE,
      '#translatable' => true
    );

    return $form;
  }
}
