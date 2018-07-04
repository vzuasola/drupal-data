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
 *     "parent" = "games_page_loading.list",
 *     "weight" = 11
 *   },
 * )
 */


class GamesPageLoadingForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['virtual_config.games_loading_configuration'];
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
      '#translatable' => TRUE,
    ];


    return $form;
  }

}
