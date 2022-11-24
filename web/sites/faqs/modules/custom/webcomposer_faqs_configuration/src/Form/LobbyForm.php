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
 *     "title" = "Faqs Lobby Form and SEO Cricket Configuration",
 *     "path" = "/admin/config/webcomposer/config/faqs_lobby_configuration",
 *   },
 *   menu = {
 *     "title" = "Faqs Lobby Configuration and Cricket Configuration",
 *     "description" = "Provides Faqs Lobby and SEO Cricket Configuration",
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
      '#title' => t('Faqs Lobby and SEO Cricket Configuration'),
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

    $form['cricket_configuration'] = [
      '#type' => 'details',
      '#title' => t('Cricket Configuration'),
      '#group' => 'advanced',
    ];

    $form['cricket_configuration']['related_article'] = [
      '#type' => 'details',
      '#title' => $this->t('Related Article - (✓)hide | (✕)show'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['cricket_configuration']['related_article']['enable_related_article_homepage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Cricket Homepage'),
      '#default_value' => $this->get('enable_related_article_homepage'),
      '#translatable' => TRUE,
    ];

    $form['cricket_configuration']['related_article']['enable_related_article_innerpage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Cricket Innerpage'),
      '#default_value' => $this->get('enable_related_article_innerpage'),
      '#translatable' => TRUE,
    ];

    $form['cricket_configuration']['cricket_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Define the title for the Cricket'),
      '#default_value' => $this->get('cricket_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['cricket_configuration']['cricket_subtitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sub Title'),
      '#description' => $this->t('Define the subtitle for the Cricket'),
      '#default_value' => $this->get('cricket_subtitle'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['cricket_configuration']['read_more'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Read More Texts'),
      '#description' => $this->t('Link texts for articles.'),
      '#default_value' => $this->get('read_more'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['cricket_configuration']['cricket_related_subtitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sub Related Title'),
      '#description' => $this->t('Define the related subtitle for the Cricket'),
      '#default_value' => $this->get('cricket_related_subtitle'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['social_media_widgets'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media Widgets'),
      '#group' => 'advanced',
    ];

    // Product Settings
    $form['social_media_widgets']['widgets_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Widgets'),
      '#default_value' => $this->get('widgets_list'),
      '#description' => $this->t('Enter one widget name per line. Max 5 widgets.'),
      '#translatable' => TRUE,
    ];

    $widgets = array_map('trim', explode(PHP_EOL, $this->get('widgets_list')));

    foreach ($widgets as $widget) {
      $widget_key = str_replace(' ', '', strtolower($widget));
      // Skip if empty
      if (empty($widget_key)) {
        continue;
      }

      $form['social_media_widgets'][$widget_key] = [
        '#type' => 'details',
        '#title' => $this->t($widget),
      ];

      $form['social_media_widgets'][$widget_key]['code_' . $widget_key] = [
        '#type' => 'textarea',
        '#title' => $this->t('Code'),
        '#default_value' => $this->get('code_' . $widget_key),
        '#description' => $this->t('Html / Javascript code to render social media post'),
        '#translatable' => TRUE,
      ];
    }
  }

    /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Check for max widget count
    $widgets = array_map('trim', explode(PHP_EOL, $form_state->getValue('widgets_list')));
    if (count($widgets) > 5) {
      $form_state->setErrorByName('widgets_list', $this->t('The maximum amount of widgets is 5'));
    }
  }
}
