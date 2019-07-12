<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_news_and_updates",
 *   route = {
 *     "title" = "News and Updates Configuration",
 *     "path" = "/admin/config/zipang/news_and_updates_configuration",
 *   },
 *   menu = {
 *     "title" = "News and Updates Configuration",
 *     "description" = "Provides News and Updates configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangNewsAndUpdatesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.news_and_updates_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('News and Updates Configuration'),
    ];

    $this->sectionNewsAndUpdates($form);

    return $form;
  }

  private function sectionNewsAndUpdates(array &$form) {

    $form['news_and_updates'] = [
      '#type' => 'details',
      '#title' => t('News and Updates Configuration'),
      '#group' => 'advanced',
    ];

    $form['news_and_updates']['news_and_updates_title'] = [
      '#type' => 'textfield',
      '#title' => t('News and Updates Title'),
      '#default_value' => $this->get('news_and_updates_title'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['news_and_updates']['news_and_updates_year'] = [
      '#type' => 'textfield',
      '#title' => t('News and Updates Year Text'),
      '#default_value' => $this->get('news_and_updates_year'),
      '#translatable' => TRUE,
    ];

    $form['news_and_updates']['news_and_updates_month'] = [
      '#type' => 'textfield',
      '#title' => t('News and Updates Month Text'),
      '#default_value' => $this->get('news_and_updates_month'),
      '#translatable' => TRUE,
    ];

    $form['news_and_updates']['news_and_updates_date'] = [
      '#type' => 'textfield',
      '#title' => t('News and Updates Date Text'),
      '#default_value' => $this->get('news_and_updates_date'),
      '#translatable' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
  }
