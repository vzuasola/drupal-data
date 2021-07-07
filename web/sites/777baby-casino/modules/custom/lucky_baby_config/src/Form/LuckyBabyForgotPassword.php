<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_forgot_password",
 *   route = {
 *     "title" = "Lucky Baby Forgot Password Configuration",
 *     "path" = "/admin/config/lucky_baby/forgot_password_configuration",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby Forgot Password Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyForgotPassword extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.forgot_password_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Forgot Password Configuration'),
    ];

    $this->sectionForgotPassword($form);
    $this->sectionError($form);
    $this->sectionPopup($form);
    $this->sectionSuccess($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */

  private function sectionForgotPassword(array &$form) {
    // form setting
    $form['forgot_pass'] = [
      '#type' => 'details',
      '#title' => t('Forgot Password Configuration'),
      '#group' => 'advanced',
    ];
    $form['forgot_pass']['form']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];
    $form['forgot_pass']['form']['path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Path'),
      '#default_value' => $this->get('path'),
      '#translatable' => TRUE,
    ];
    $form['forgot_pass']['form']['username_acc'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#default_value' => $this->get('username_acc'),
      '#translatable' => TRUE,
    ];
    $form['forgot_pass']['form']['email_acc'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#default_value' => $this->get('email_acc'),
      '#translatable' => TRUE,
    ];
    $form['forgot_pass']['form']['submit_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Submit Button'),
      '#default_value' => $this->get('submit_button'),
      '#translatable' => TRUE,
    ];
    $d = $this->get('header');
    $form['forgot_pass']['form']['header'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Description header'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
      ];
    $d = $this->get('footer');
    $form['forgot_pass']['form']['footer'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Footer'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
    ];
  }

  private function sectionPopup(array &$form) {
    // form setting
    $form['forgot_popup'] = [
      '#type' => 'details',
      '#title' => t('Forgot Password Popup'),
      '#group' => 'advanced',
    ];

    $form['forgot_popup']['form']['popup_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('popup_title'),
      '#translatable' => TRUE,
    ];

    $form['forgot_popup']['form']['popup_forgot_tab'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Forgot Password Tab Label'),
      '#default_value' => $this->get('popup_forgot_tab'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('popup_header');
    $form['forgot_popup']['form']['popup_header'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Header'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
    ];

    $d = $this->get('popup_footer');
    $form['forgot_popup']['form']['popup_footer'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Footer'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
    ];

    $form['forgot_popup']['form']['popup_ok'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Ok Button label'),
      '#default_value' => $this->get('popup_ok'),
      '#translatable' => TRUE,
    ];

    $form['forgot_popup']['form']['popup_success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Title'),
      '#default_value' => $this->get('popup_success_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('popup_success_message');
    $form['forgot_popup']['form']['popup_success_message'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Success Message'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
    ];

  }

  private function sectionSuccess(array &$form) {
    // form setting
    $form['forgot_success'] = [
      '#type' => 'details',
      '#title' => t('Forgot Success Config'),
      '#group' => 'advanced',
    ];

    $form['forgot_success']['form']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success forgot password title'),
      '#default_value' => $this->get('success_title'),
      '#translatable' => TRUE,
    ];

    $form['forgot_success']['form']['success'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success forgot password message'),
      '#default_value' => $this->get('success'),
      '#translatable' => TRUE,
    ];

    $form['forgot_success']['form']['button_success'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Success label'),
      '#default_value' => $this->get('button_success'),
      '#translatable' => TRUE,
    ];

  }

  private function sectionError(array &$form) {
    // form setting
    $form['forgot_error'] = [
      '#type' => 'details',
      '#title' => t('Forgot Error Config'),
      '#group' => 'advanced',
    ];

    $form['forgot_error']['form']['username_error'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username required field error message'),
      '#default_value' => $this->get('username_error'),
      '#translatable' => TRUE,
    ];

    $form['forgot_error']['form']['email_error'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email required field error message'),
      '#default_value' => $this->get('email_error'),
      '#translatable' => TRUE,
    ];
  }

}