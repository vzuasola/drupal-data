<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_als_config_form",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/ghana/als_configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides General configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 10
 *   },
 * )
 */

class GhanaALSConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ghana_config.als_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
        '#type' => 'vertical_tabs',
        '#title' => t('General Configuration'),
    ];

    $this->integrationConfig($form);
    $this->sectionPageSetting($form);
    $this->resetPasswordConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['als_configuration_setting'] = [
      '#type' => 'details',
      '#title' => t('ALS Configuration'),
      '#group' => 'advanced',
    ];

    $form['als_configuration_setting']['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ALS URL'),
      '#default_value' => $this->get('als_url'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_cookie_url_pre'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Pre login)'),
      '#default_value' => $this->get('als_cookie_url_pre'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_cookie_url_post'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Post login)'),
      '#default_value' => $this->get('als_cookie_url_post'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['domains'] = [
      '#type' => 'details',
      '#title' => $this->t('Domain'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['als_configuration_setting']['domains']['als_enable_domain'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Domain Mapping'),
      '#default_value' => $this->get('als_enable_domain'),
      '#description' => 'Auto generate als domain base on the current site domain.',
      '#translatable' => TRUE,
    ];

    $form['footer_configuration_setting'] = [
      '#type' => 'details',
      '#title' => $this->t('Footer Setting'),
      '#group' => 'advanced',
    ];

    $form['footer_configuration_setting']['ghana_footer_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('ghana_footer_title'),
      '#translatable' => TRUE,
    ];

    $c = $this->get('ghana_footer_desc');
    $form['footer_configuration_setting']['ghana_footer_desc'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description'),
      '#default_value' => $c['value'],
      '#format' => $c['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   * Integration Configuration.
   */
  private function integrationConfig(&$form) {
    $form['cant_login_integration_config'] = [
      '#type' => 'details',
      '#title' => t("Integration"),
      '#group' => 'advanced',
    ];

    $form['cant_login_integration_config']['cant_login_response_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Response Code Mapping'),
      '#required' => TRUE,
      '#description' => $this->t('Cant Login API Response Code Mapping'),
      '#default_value' => $this->get('cant_login_response_mapping'),
      '#translatable' => TRUE,
    ];

    $form['cant_login_integration_config']['error_mid_down'] = [
      '#type' => 'textarea',
      '#title' => t('Error Message MID Down'),
      '#size' => 500,
      '#required' => TRUE,
      '#description' => $this->t('General Error Message across all forms of my account if MID is down.'),
      '#default_value' => $this->get('error_mid_down'),
      '#translatable' => TRUE,
    ];
  }


  /**
   * Reset Password Configuration.
   */
  private function resetPasswordConfig(&$form) {
    $form['cant_login_reset_password_config'] = [
      '#type' => 'details',
      '#title' => t("Reset Password"),
      '#group' => 'advanced',
    ];

    $content = $this->get('forgot_username_success_message');
    $form['cant_login_reset_password_config']['forgot_username_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Forgot Username Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];


    $content = $this->get('reset_password_success_message');
    $form['cant_login_reset_password_config']['reset_password_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Reset Password Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('expired_message');
    $form['cant_login_reset_password_config']['expired_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Expired Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}
