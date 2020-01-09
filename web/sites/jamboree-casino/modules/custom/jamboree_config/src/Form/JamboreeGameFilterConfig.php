<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_forgot_password",
 *   route = {
 *     "title" = "Game Filter Configuration",
 *     "path" = "/admin/config/jamboree/forgot_password_configuration",
 *   },
 *   menu = {
 *     "title" = "Game Filter Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeGameFilterConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.game_filter_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Forgot Password Configuration'),
    ];

    $this->sectionGeneralConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */

  private function sectionGeneralConfig(array &$form) {
    // form setting
    $form['game_filter'] = [
      '#type' => 'details',
      '#title' => t('Game Filter Configuration'),
      '#group' => 'advanced',
    ];
    $form['game_filter']['form']['game_filter_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game filter title'),
      '#default_value' => $this->get('game_filter_title'),
      '#translatable' => TRUE,
    ];
    $form['game_filter']['form']['game_filter_game_provider'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game provider title'),
      '#default_value' => $this->get('game_filter_game_provider'),
      '#translatable' => TRUE,
    ];
    $form['game_filter']['form']['game_filter_apply'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Apply button title'),
        '#default_value' => $this->get('game_filter_apply'),
        '#translatable' => TRUE,
    ];
      $form['game_filter']['form']['game_filter_reset'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Reset button title'),
        '#default_value' => $this->get('game_filter_reset'),
        '#translatable' => TRUE,
    ];
    $d = $this->get('game_filter_description');
    $form['game_filter']['form']['game_filter_description'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Game filter description'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
      ];
  }

}