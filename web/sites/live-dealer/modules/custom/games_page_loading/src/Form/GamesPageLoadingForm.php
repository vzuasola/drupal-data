<?php

namespace Drupal\games_page_loading\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games Page Loading form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_page_loading",
 *   route = {
 *     "title" = "Games Page Loading Configuration",
 *     "path" = "/admin/games/page-loading-config",
 *   },
 *   menu = {
 *     "title" = "Games Page Loading Custom Configuration",
 *     "description" = "Configure the Games Page Loading Messages",
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
  public function getFormId() {
    return 'games_page_loading.games_loading_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['games_loading_configuration_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['loading_message'] = [
      '#type' => 'details',
      '#title' => $this->t('Loading Message Settings'),
      '#collapsible' => TRUE,
      '#group' => 'games_loading_configuration_tab'
    ];

    $loading_message_content = $this->get('loading_message_content');
    $form['loading_message']['loading_message_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Loading Message Content'),
      '#description' => $this->t('The text to display on game page loading message.'),
      '#default_value' =>  $loading_message_content['value'],
      '#format' => $loading_message_content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $loading_error_message = $this->get('loading_error_message');
    $form['loading_message']['loading_error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Loading Error Message Content'),
      '#description' => $this->t('The text to display on game page loading upon error.'),
      '#default_value' => $loading_error_message['value'],
      '#format' => $loading_error_message['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
