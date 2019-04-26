<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_cant_login_form",
 *   route = {
 *     "title" = "Cant Login Page Configuration",
 *     "path" = "/admin/config/ghana/cant_login_configuration",
 *   },
 *   menu = {
 *     "title" = "Cant Login Page Configuration",
 *     "description" = "Provides cant login page configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class GhanaCantLoginForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['ghana_config.cant_login_configuration'];
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
        $form['page_forgot_password_setting'] = [
            '#type' => 'details',
            '#title' => t('Forgot Password Setting'),
            '#group' => 'advanced',
        ];

        $form['page_forgot_password_setting']['page_host_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Host URL'),
            '#default_value' => $this->get('page_host_url'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_username_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Username Label'),
            '#default_value' => $this->get('page_username_label'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_username_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Username Placeholder'),
            '#default_value' => $this->get('page_username_placeholder'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_pin_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Pin Label'),
            '#default_value' => $this->get('page_pin_label'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_pin_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Pin Placeholder'),
            '#default_value' => $this->get('page_pin_placeholder'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_submit_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Button Label'),
            '#default_value' => $this->get('page_submit_label'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $this->get('page_title'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_tab_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tab Title'),
            '#default_value' => $this->get('page_tab_title'),
            '#translatable' => true,
        ];

        $form['page_forgot_password_setting']['page_form_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Form Title'),
            '#default_value' => $this->get('page_form_title'),
            '#translatable' => true,
        ];

        $c = $this->get('page_form_desc');
        $form['page_forgot_password_setting']['page_form_desc'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Form Description'),
            '#default_value' => $c['value'],
            '#format' => $c['format'],
            '#translatable' => true,
        ];

        $c = $this->get('page_form_footer');
        $form['page_forgot_password_setting']['page_form_footer'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Form Footer'),
            '#default_value' => $c['value'],
            '#format' => $c['format'],
            '#translatable' => true,
        ];

        $form['page_confirmation_message_setting'] = [
            '#type' => 'details',
            '#title' => t('Confirmation Message Setting'),
            '#group' => 'advanced',
        ];

        $form['page_confirmation_message_setting']['page_cm_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Title'),
            '#default_value' => $this->get('page_cm_title'),
            '#translatable' => true,
        ];

        $form['page_confirmation_message_setting']['page_button_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Button Label'),
            '#default_value' => $this->get('page_button_label'),
            '#translatable' => true,
        ];

        $form['page_confirmation_message_setting']['page_button_link'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Button Link'),
            '#default_value' => $this->get('page_button_link'),
            '#translatable' => true,
        ];

        $c = $this->get('page_cm_desc');
        $form['page_confirmation_message_setting']['page_cm_desc'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Form Description'),
            '#default_value' => $c['value'],
            '#format' => $c['format'],
            '#translatable' => true,
        ];
    }
}
