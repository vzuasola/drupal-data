<?php

namespace Drupal\zipang_canonical\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_canonical",
 *   route = {
 *     "title" = "Zipang Canonical Configuration",
 *     "path" = "/admin/config/zipang/canonical_configuration",
 *   },
 *   menu = {
 *     "title" = "Zipang Canonical Configuration",
 *     "description" = "Provides canonical page configuration",
 *     "parent" = "zipang_canonical.zipang_canonical",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangCanonicalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_canonical.zipang_canonical'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Zipang Configurations'),
    ];

    $this->section404PageConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function section404PageConfig(array &$form) {
    $form['not_found_config'] = [
      '#type' => 'details',
      '#title' => $this->t('Canonical'),
    ];

    $default_404_page_title = $this->get('not_found_title');
    $form['not_found_config']['not_found_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('404 Page Title'),
      '#default_value' => $default_404_page_title,
      '#translatable' => TRUE,
    ];

    $default_404_page_body = $this->get('not_found_body');
    $form['not_found_config']['not_found_body'] = [
      '#type' => 'text_format',
      '#title' => t('404 Page Body'),
      '#default_value' => $default_404_page_body['value'],
      '#description' => $this->t('404 Page Body.'),
      '#format' => $default_404_page_body['format'],
      '#translatable' => TRUE,
    ];

  }
}
