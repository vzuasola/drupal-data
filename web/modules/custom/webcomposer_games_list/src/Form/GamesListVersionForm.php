<?php

namespace Drupal\webcomposer_games_list\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Games List Version configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "games_list_version_form",
 *   route = {
 *     "title" = "Games List Version Configuration",
 *     "path" = "/admin/config/webcomposer/games/games-list-version",
 *   },
 *   menu = {
 *     "title" = "Games List Version Configuration",
 *     "description" = "Provides a form for customizing games list version module",
 *     "parent" = "webcomposer_games_list.list",
 *   },
 * )
 */
class GamesListVersionForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_games_list.version_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['version_configuration'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Games List V2'),
      '#description' => $this->t("Version control for games list"),
      '#default_value' => $this->get('version_configuration'),
      '#translatable' => true,
      '#required' => false,
    ];

    return $form;
  }
}
