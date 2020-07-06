<?php
namespace Drupal\webcomposer_lightbox\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Login Timeout Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "login_timeout_form",
 *   route = {
 *     "title" = "Login Timeout Configuration",
 *     "path" = "/admin/config/webcomposer/lightbox/login-timeout",
 *   },
 *   menu = {
 *     "title" = "Login Timeout Configuration",
 *     "description" = "Provides configuration for login timeout",
 *     "parent" = "webcomposer_lightbox.list",
 *     "weight" = 10
 *   },
 * )
 */
class LoginTimeoutConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * Login Timeout Configuration definitions
   */
  /**
   * Login Timeout Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.login_timeout'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['login_timeout_configuration_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['login_timeout_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Timeout Lightbox Title'),
      '#default_value' => $this->get('login_timeout_title'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['login_timeout_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Login Timeout Lightbox Message'),
      '#default_value' => $this->get('login_timeout_message')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['login_timeout_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Timeout Lightbox Button Text'),
      '#description' => $this->t('Text inside the button'),
      '#default_value' => $this->get('login_timeout_button'),
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }
}
