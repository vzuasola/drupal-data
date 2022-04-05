<?php
namespace Drupal\webcomposer_faqs_configuration\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Faqs Lobby form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_faqs_configuration",
 *   route = {
 *     "title" = "Faqs Lobby Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/faqs_lobby_configuration",
 *   },
 *   menu = {
 *     "title" = "Faqs Lobby Configuration",
 *     "description" = "Provides Faqs Lobby configuration",
 *     "parent" = "webcomposer_faqs_configuration.list",
 *     "weight" = 30
 *   },
 * )
 */
class LobbyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_faqs_configuration.lobby',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lobby_form';
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Faqs Lobby Configuration'),
    ];

    $this->sectionLobby($form);

    return $form;
  }

  /**
   *
   */
  private function sectionLobby(array &$form)
  {
    $form['lobby_configuration'] = [
      '#type' => 'details',
      '#title' => t('Lobby Configuration'),
      '#group' => 'advanced',
    ];


    $form['lobby_configuration']['lobby_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Define the title for the Lobby'),
      '#default_value' => $this->get('lobby_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['lobby_configuration']['language_whitelisting'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Whitelisting'),
      '#description' => $this->t('Define the list of allowed languages separated by "|"'),
      '#default_value' => $this->get('language_whitelisting'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

  }
}
