<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_my_account_form",
 *   route = {
 *     "title" = "My Account Page Configuration",
 *     "path" = "/admin/config/ghana/my_account_configuration",
 *   },
 *   menu = {
 *     "title" = "My Account Page Configuration",
 *     "description" = "Provides my account page configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class GhanaMyAccountForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['ghana_config.my_account_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('My Account Configuration'),
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form) {
        $form['page_profile_setting'] = [
            '#type' => 'details',
            '#title' => t('Profile Setting'),
            '#group' => 'advanced',
        ];

        $form['page_profile_setting']['server_side_validation'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Server-side Validation Mapping'),
            '#required' => TRUE,
            '#default_value' => $this->get('server_side_validation'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation'] = [
            '#type' => 'details',
            '#title' => 'Review Changes Lightbox Settings',
            '#open' => False,
        ];

        $form['page_profile_setting']['password_validation']['required_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Error Message'),
            '#required' => true,
            '#default_value' => $this->get('required_validation'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['password_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('password_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['submit_lightbox_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Lightbox Label'),
            '#required' => true,
            '#default_value' => $this->get('submit_lightbox_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Title'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_title'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_table_description'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Table Description'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_table_description'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_password_description'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Password Description'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_password_description'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['saving_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Saving Message'),
            '#required' => true,
            '#default_value' => $this->get('saving_message'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['current_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current Label'),
            '#required' => true,
            '#default_value' => $this->get('current_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['new_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Label'),
            '#required' => true,
            '#default_value' => $this->get('new_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings'] = [
            '#type' => 'details',
            '#title' => 'Form Settings',
            '#open' => False,
        ];

        $form['page_profile_setting']['form_settings']['first_name_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First Name Label'),
            '#required' => true,
            '#default_value' => $this->get('first_name_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['first_name_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First Name Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('first_name_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['last_name_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Last Name Label'),
            '#required' => true,
            '#default_value' => $this->get('last_name_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['last_name_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Last Name Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('last_name_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['username_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Username Label'),
            '#required' => true,
            '#default_value' => $this->get('username_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['username_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Username Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('username_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['email_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email Label'),
            '#required' => true,
            '#default_value' => $this->get('email_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['email_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('email_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['pin_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Pin Label'),
            '#required' => true,
            '#default_value' => $this->get('pin_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['pin_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Pin Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('pin_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['country_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Country Label'),
            '#required' => true,
            '#default_value' => $this->get('country_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['country_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Country Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('country_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['birthdate_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Birthdate Label'),
            '#required' => true,
            '#default_value' => $this->get('birthdate_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['birthdate_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Birthdate Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('birthdate_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['question_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Question Label'),
            '#required' => true,
            '#default_value' => $this->get('question_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['answer_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Answer Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('answer_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings']['submit_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Label'),
            '#required' => true,
            '#default_value' => $this->get('submit_label'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting'] = [
            '#type' => 'details',
            '#title' => t('Change Password Setting'),
            '#group' => 'advanced',
        ];

        $form['page_change_password_setting']['page_current_password_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current Password Label'),
            '#default_value' => $this->get('page_current_password_label'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_current_password_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current Password Placeholder'),
            '#default_value' => $this->get('page_current_password_placeholder'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_new_password_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Password Label'),
            '#default_value' => $this->get('page_new_password_label'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_new_password_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Password Placeholder'),
            '#default_value' => $this->get('page_new_password_placeholder'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_confirm_password_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Confirm Password Label'),
            '#default_value' => $this->get('page_confirm_password_label'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_confirm_password_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Confirm Password Placeholder'),
            '#default_value' => $this->get('page_confirm_password_placeholder'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_change_password_submit'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Button Label'),
            '#default_value' => $this->get('page_change_password_submit'),
            '#translatable' => true,
        ];

        $c = $this->get('page_change_password_desc');
        $form['page_change_password_setting']['page_change_password_desc'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Form Description'),
            '#default_value' => $c['value'],
            '#format' => $c['format'],
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['change_password_integration_error'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Integration Error Messages'),
            '#description' => $this->t('Integration error list.'),
            '#default_value' => $this->get('change_password_integration_error'),
            '#translatable' => TRUE,
        ];

    }
}
