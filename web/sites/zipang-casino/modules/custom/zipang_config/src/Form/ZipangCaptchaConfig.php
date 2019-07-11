<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_captcha_configuration",
 *   route = {
 *     "title" = "Zipang Captcha Configuration",
 *     "path" = "/admin/config/zipang/captcha_configuration",
 *   },
 *   menu = {
 *     "title" = "Zipang Captcha Configuration",
 *     "description" = "Provides Captcha configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangCaptchaConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.zipang_captcha_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Zipang Captcha Configuration'),
    ];

    $this->sectionCaptchaSettings($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionCaptchaSettings(array &$form) {
    $form['captcha_settings'] = [
      '#type' => 'details',
      '#title' => t('Captcha Settings'),
      '#group' => 'advanced',
    ];
    $form['captcha_settings']['captcha_error_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Captcha Field Error Message'),
      '#default_value' => $this->get('captcha_error_message'),
      '#translatable' => TRUE,
    ];
  }
}
