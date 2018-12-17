<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_captcha_configuration",
 *   route = {
 *     "title" = "Jamboree Captcha Configuration",
 *     "path" = "/admin/config/jamboree/captcha_configuration",
 *   },
 *   menu = {
 *     "title" = "Jamboree Captcha Configuration",
 *     "description" = "Provides Captcha configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeCaptchaConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.jamboree_captcha_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Captcha Configuration'),
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
