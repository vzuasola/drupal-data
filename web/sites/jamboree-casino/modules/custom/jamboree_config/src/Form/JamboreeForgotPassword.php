<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_forgot_password",
 *   route = {
 *     "title" = "Jamboree Forgot Password Configuration",
 *     "path" = "/admin/config/jamboree/forgot_password_configuration",
 *   },
 *   menu = {
 *     "title" = "Jamboree Forgot Password Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeForgotPassword extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.forgot_password_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Forgot Password Configuration'),
    ];

    $this->sectionForgotPassword($form);

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
    $d = $this->get('header');
    $form['forgot_pass']['form']['header'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Description header'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#translatable' => TRUE,
      ];
  }

}