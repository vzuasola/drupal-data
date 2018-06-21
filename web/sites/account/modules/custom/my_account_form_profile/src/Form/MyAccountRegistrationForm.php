<?php

namespace Drupal\my_account_form_profile\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;

use Drupal\Core\Form\FormStateInterface;


/**
 * My Account - Access Denied.
 *
 * @WebcomposerConfigPlugin(
 *   id = "profile_form",
 *   route = {
 *     "title" = "Profile Form",
 *     "path" = "/admin/config/my_account/profile",
 *   },
 *   menu = {
 *     "title" = "Profile Form",
 *     "description" = "My Account - Profile Form",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */

class MyAccountRegistrationForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {

        return ['my_account_form_profile.profile'];
    }

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function form(array $form, FormStateInterface $form_state)
    {
        $form['profile'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['contact_preference'] = [
            '#type' => 'details',
            '#title' => 'Contact Prefrence',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['contact_preference']['contact_preference_yes_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference True Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('contact_preference_yes_label'),
            '#translatable' => true,
        ];

        $form['contact_preference']['contact_preference_no_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference False Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('contact_preference_no_label'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification'] = [
            '#type' => 'details',
            '#title' => 'SMS Verification',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_sms_verification']['enable_sms_verification'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable SMS Verification'),
            '#required' => FALSE,
            '#description' => $this->t('SMS Verification Feature Toggling'),
            '#default_value' => $this->get('enable_sms_verification'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verify_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Verify Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for Verify Link'),
            '#default_value' => $this->get('verify_text_field'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verify_header_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verify Header Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify text header'),
            '#default_value' => $this->get('modal_verify_header_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verify_body_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Verify Body Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify body text'),
            '#default_value' => $this->get('modal_verify_body_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verification_code_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verification Code Placeholder'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Placeholder text for verification field textfield'),
            '#default_value' => $this->get('modal_verification_code_placeholder'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_sms_verification']['modal_verification_resend_code_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Resend Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for resend verification code'),
            '#default_value' => $this->get('modal_verification_resend_code_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verification_submit_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Submit Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for submit verification code'),
            '#default_value' => $this->get('modal_verification_submit_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_response'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Response from ICore'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Response from ICore'),
            '#default_value' => $this->get('verification_code_response'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_required_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Required Field Error Message'),
            '#default_value' => $this->get('verification_code_required_message'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_min_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Min Length Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Min Length Field Error Message'),
            '#default_value' => $this->get('verification_code_min_length_message'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_max_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Max Length Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Max Length Field Error Message'),
            '#default_value' => $this->get('verification_code_max_length_message'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_country_mapping'] = [
            '#type' => 'details',
            '#title' => 'Country Mapping',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_country_mapping']['country_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $this->get('country_mapping'),
        ];

        $form['field_labels_country_mapping']['country_code_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Code Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $this->get('country_code_mapping'),
        ];

        $form['field_labels_modal_preview'] = [
            '#type' => 'details',
            '#title' => 'Modal Preview',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_modal_preview']['modal_preview_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Header'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_header'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_top_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Top Blurb'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_top_blurb'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_current_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Current Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_current_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_modal_preview']['modal_preview_new_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview New Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_new_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_modal_preview']['modal_preview_bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Bottom Blurb'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_bottom_blurb'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Password Placeholder'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_placeholder'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_btn'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Button'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_btn'),
            '#translatable' => true,
        ];

        $form['field_labels_validation_configuration'] = [
            '#type' => 'details',
            '#title' => 'Validation Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_validation_configuration']['server_side_validation'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Server-side Validation Mapping'),
            '#required' => TRUE,
            '#default_value' => $this->get('server_side_validation'),
            '#translatable' => true,
        ];

        $form['field_labels_validation_configuration']['password_validation'] = [
            '#type' => 'details',
            '#title' => 'Password',
            '#open' => False,
        ];

        $form['field_labels_validation_configuration']['password_validation']['required_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Error Message'),
            '#required' => true,
            '#default_value' => $myAccountConfigValue['required_validation'],
        ];

        $form['field_labels_validation_configuration']['password_validation']['password_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $this->get('password_format_validation'),
            '#translatable' => true,
        ];

        $form['field_labels_validation_configuration']['password_validation']['password_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Min Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $this->get('password_min_length_validation'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_validation_configuration']['password_validation']['password_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $this->get('password_max_length_validation'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration'] = [
            '#type' => 'details',
            '#title' => 'Generic Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_generic_configuration']['primary_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for primary mobile number tagging'),
            '#required' => TRUE,
            '#default_value' => $this->get('primary_label'),
            '#translatable' => true,
        ];

        $form['field_labels_generic_configuration']['add_mobile_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for adding mobile number link'),
            '#required' => TRUE,
            '#default_value' => $this->get('add_mobile_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['no_changed_detected_message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Message if no changed has been detected'),
            '#required' => TRUE,
            '#default_value' => $this->get('no_changed_detected_message'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['male_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for Male'),
            '#required' => TRUE,
            '#default_value' => $this->get('male_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['female_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for Female'),
            '#required' => TRUE,
            '#default_value' => $this->get('female_label'),
            '#translatable' => true,
        ];

        return $form;
    }
}
