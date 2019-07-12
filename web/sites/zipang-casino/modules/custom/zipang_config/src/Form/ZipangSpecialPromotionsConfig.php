<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_release",
 *   route = {
 *     "title" = "Special Promotions Page Configuration",
 *     "path" = "/admin/config/zipang/release_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Special Promotions Page Configuration",
 *     "description" = "Provides Special Promotions Page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangSpecialPromotionsConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.special_promotions_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Special Promotion Page Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['page_setting'] = [
      '#type' => 'details',
      '#title' => t('Special Promotion Page Setting'),
      '#group' => 'advanced',
    ];

    $d = $this->get('page_description');
    $form['page_setting']['page_description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['page_setting']['category_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Category Text'),
      '#default_value' => $this->get('category_text'),
      '#translatable' => TRUE,
    ];

    $form['page_setting']['read_more_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Read More Text'),
      '#default_value' => $this->get('read_more_text'),
      '#translatable' => TRUE,
    ];
  }
}
