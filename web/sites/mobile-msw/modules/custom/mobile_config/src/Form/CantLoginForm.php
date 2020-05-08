<?php

namespace Drupal\mobile_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "cant_login_form",
 *   route = {
 *     "title" = "Cant Login Page Configuration",
 *     "path" = "/admin/config/cant_login/cant_login_configuration",
 *   },
 *   menu = {
 *     "title" = "Cant Login Page Configuration",
 *     "description" = "Provides cant login page configuration",
 *     "parent" = "mobile_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class CantLoginForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['mobile_config.cant_login_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('Cant Login Configuration'),
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form) {

        // Forgot Password
        $form['page_forgot_password_setting'] = [
            '#type' => 'details',
            '#title' => t('Forgot Password Setting'),
            '#group' => 'advanced',
        ];

        $form['page_forgot_password_setting']['forgot_password_success_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Forgot Password Success Message'),
            '#default_value' => $this->get('forgot_password_success_message'),
            '#format' => $content['format'],
            '#required' => FALSE,
            '#translatable' => TRUE,
        ];

        // Reset Password
        $form['page_reset_password_setting'] = [
            '#type' => 'details',
            '#title' => t('Reset Password Setting'),
            '#group' => 'advanced',
        ];

        $form['page_reset_password_setting']['reset_password_success_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Reset Password Success Message'),
            '#default_value' => $content['value'],
            '#format' => $content['format'],
            '#required' => FALSE,
            '#translatable' => TRUE,
        ];

        $form['page_reset_password_setting']['reset_password_error_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Reset Password Error Message'),
            '#default_value' => $content['value'],
            '#format' => $content['format'],
            '#required' => FALSE,
            '#translatable' => TRUE,
        ];

        $form['page_reset_password_setting']['expired_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Expired Message'),
            '#default_value' => $content['value'],
            '#format' => $content['format'],
            '#required' => FALSE,
            '#translatable' => TRUE,
        ];

        //Integration
        $form['cant_login_integration_config'] = [
            '#type' => 'details',
            '#title' => t("Integration"),
            '#group' => 'advanced',
        ];
    
        $form['cant_login_integration_config']['cant_login_response_mapping'] = [
            '#type' => 'textarea',
            '#title' => t('Response Code Mapping'),
            '#required' => FALSE,
            '#description' => $this->t('Cant Login API Response Code Mapping'),
            '#default_value' => $this->get('cant_login_response_mapping'),
            '#translatable' => TRUE,
        ];
    
        $form['cant_login_integration_config']['error_mid_down'] = [
            '#type' => 'textarea',
            '#title' => t('Error Message MID Down'),
            '#size' => 500,
            '#required' => FALSE,
            '#description' => $this->t('General Error Message across all forms of my account if MID is down.'),
            '#default_value' => $this->get('error_mid_down'),
            '#translatable' => TRUE,
        ];

    }

}
