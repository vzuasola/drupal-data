<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_faq",
 *   route = {
 *     "title" = "FAQ Page Configuration",
 *     "path" = "/admin/config/zipang/faq_configuration",
 *   },
 *   menu = {
 *     "title" = "FAQ Page Configuration",
 *     "description" = "Provides FAQ page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangFAQForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.faq_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('FAQ Page Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['faq'] = [
      '#type' => 'details',
      '#title' => t('FAQ Page Setting'),
      '#group' => 'advanced',
    ];

    $form['faq']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('page_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('page_description');
    $form['faq']['page_description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['faq']['search_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search Field Placeholder'),
      '#default_value' => $this->get('search_placeholder'),
      '#translatable' => TRUE,
    ];

    $form['faq']['error_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $this->get('error_message'),
      '#translatable' => TRUE,
    ];
  }
}
