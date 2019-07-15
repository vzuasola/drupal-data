<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_gallery",
 *   route = {
 *     "title" = "Gallery Page Configuration",
 *     "path" = "/admin/config/zipang/gallery_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Gallery Page Configuration",
 *     "description" = "Provides gallery page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangGalleryForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.gallery_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Gallery Page Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['gallery_setting'] = [
      '#type' => 'details',
      '#title' => t('Gallery Page Setting'),
      '#group' => 'advanced',
    ];

    $form['gallery_setting']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('page_description');
    $form['gallery_setting']['page_description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['gallery_setting']['page_summary'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Summary'),
        '#default_value' => $this->get('page_summary'),
        '#translatable' => true,
    ];

    $form['gallery_setting']['page_button_label'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button Label'),
        '#default_value' => $this->get('page_button_label'),
        '#translatable' => true,
    ];

    $form['gallery_setting']['page_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('URL'),
        '#default_value' => $this->get('page_url'),
        '#translatable' => true,
    ];
  }
}
