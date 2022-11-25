<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * PlayerGame Error Handling Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "playergame_error_handling",
 *   route = {
 *     "title" = "PlayerGame Error Handling Configuration",
 *     "path" = "/admin/config/webcomposer/games/playergame_error_handling",
 *   },
 *   menu = {
 *     "title" = "PlayerGame Error Handling Configuration",
 *     "description" = "Provides configuration for playergame errors",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 11
 *   },
 * )
 */
class PlayerGameErrorConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
  /**
   * PlayerGame Error Handling Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.playergame_error_handling'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['playergame_error_handling_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['playergame_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('ErrorCode Mapping'),
      '#default_value' => $this->get('playergame_error_message'),
      '#rows' => 7,
      '#cols' => 2,
      /*'#description' => $this->t('Format of data in field (Error code | description)'),*/
      '#description' => $this->t('<b>Error code | description</b><br><ul>
    <li><b>GPD001</b>: <i>ServiceError</i></li>
    <li><b>GPD002</b>: <i>InvalidProvider</i></li>
    <li><b>GPD003</b>: <i>PlayerCheckSessionFailed</i></li>
    <li><b>GPD004</b>: <i>GameNotFound</i></li>
    <li><b>GPD005</b>: <i>GameNotAllowed</i></li>
    <li><b>GPD006</b>: <i>GameRestricted</i></li>
    <li><b>500</b>: <i>InternalError</i></li>
</ul>'),
      '#translatable' => FALSE,
      '#required' => FALSE,
    ];

    $form['gen_config']['playergame_error_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lightbox Button Text'),
      '#default_value' => $this->get('playergame_error_button'),
      '#translatable' => FALSE,
      '#required' => FALSE,
    ];
  }
}
