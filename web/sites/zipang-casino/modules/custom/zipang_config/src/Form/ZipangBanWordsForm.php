<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_ban_words",
 *   route = {
 *     "title" = "Banned words Configuration",
 *     "path" = "/admin/config/zipang/ban_words_configuration",
 *   },
 *   menu = {
 *     "title" = "Registration Banned Words Configuration",
 *     "description" = "Provides registration banned words configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangBanWordsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.zipang_ban_words'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Banned Words Configuration'),
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
        '#title' => t('Banned Words Setting'),
        '#group' => 'advanced',
      ];

    $d = $this->get('ban_words');
    $form['page_setting']['ban_words'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Banned Words'),
      '#default_value' => $d,
      '#format' => $d['format'],
      '#description' => 'One word per line. Ex. "badboy" ',
      '#translatable' => TRUE,
    ];
  }
}