<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_captcha_configuration",
 *   route = {
 *     "title" = "Lucky Baby Captcha Configuration",
 *     "path" = "/admin/config/lucky_baby/captcha_configuration",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby Captcha Configuration",
 *     "description" = "Provides Captcha configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyCaptchaConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.lucky_baby_captcha_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Lucky Baby Captcha Configuration'),
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
