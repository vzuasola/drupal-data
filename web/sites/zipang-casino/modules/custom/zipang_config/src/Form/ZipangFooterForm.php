<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_footer",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/zipang/footer_configuration",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangFooterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.footer_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionFooterBlurb($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionFooterBlurb(array &$form) {
    $form['footer'] = [
      '#type' => 'details',
      '#title' => t('Footer Blurb'),
      '#group' => 'advanced',
    ];

    $d = $this->get('footer_blurb');

    $form['footer']['footer_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Footer Blurb'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];
  }
}
