<?php

namespace Drupal\entrypage_news\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "news_section_general_config",
 *   route = {
 *     "title" = "News Section General Configuration",
 *     "path" = "/admin/news/config",
 *   },
 *   menu = {
 *     "title" = "News Section General Configuration",
 *     "description" = "Configure Contact us Blurb, Success Page and Email Template",
 *     "parent" = "entrypage_news.list",
 *     "weight" = 30
 *   },
 * )
 */
class NewsSectionConfiguration extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['news_section_config.news_section_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->newsSetting($form);

    return $form;
  }

  private function newsSetting(array &$form) {
    $form['settings'] = [
      '#type' => 'details',
      '#title' => t('New Section General Configuration'),
      '#group' => 'advanced',
    ];

    $form['settings']['tab_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Browser Tab Title'),
      '#description' => $this->t('Adds Browser Tab Title on News Section Page'),
      '#default_value' => $this->get('tab_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['section_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('News Section Title'),
      '#description' => $this->t('Adds News Section Title.'),
      '#default_value' => $this->get('section_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['see_more'] = [
      '#type' => 'textfield',
      '#title' => $this->t('See More Text'),
      '#description' => $this->t('Adds see more text on News Summary.'),
      '#default_value' => $this->get('see_more'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['pagination_next'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for "Next" pagination'),
      '#description' => $this->t('Shows as label for the next news'),
      '#default_value' => $this->get('pagination_next'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['pagination_previous'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for "Previous" pagination'),
      '#description' => $this->t('Shows as label for the previous news'),
      '#default_value' => $this->get('pagination_previous'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
}
