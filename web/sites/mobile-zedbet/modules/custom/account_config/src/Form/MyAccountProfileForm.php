<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My AccountProfile Form configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "profile_form",
 *   route = {
 *     "title" = "Profile Form",
 *     "path" = "/admin/config/my-account/profile",
 *   },
 *   menu = {
 *     "title" = "Profile Form Configuration",
 *     "description" = "Profile Form Configuration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class MyAccountProfileForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['account_config.general_configuration'];
    }

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function form(array $form, FormStateInterface $form_state) {
        $this->headerSection($form);
        $this->genericSection($form);
        $this->contactPreferenceSection($form);
        $this->countryMappingSection($form);
        $this->modalPreviewSection($form);
        $this->validationConfigurationSection($form);
        $this->mobileNumberSection($form);
        $this->smsConfigurationSection($form);
        $this->smsRateLimitSection($form);
        $this->passwordChecklistConfiguration($form);

        $form['profile'] = [
            '#type' => 'vertical_tabs',
        ];

        return $form;
    }

    /**
     * Header section configuration
     */
    private function headerSection(array &$form) {
        $form['header_configuration'] = [
            '#type' => 'details',
            '#title' => 'Header Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['header_configuration']['page_title'] = [
            '#type' => 'textfield',
            '#title' => t('Page title'),
            '#required' => TRUE,
            '#description' => $this->t('Page title shown on the browser tab for my account page.'),
            '#default_value' => $this->get('page_title'),
            '#translatable' => TRUE,
        ];

        $form['header_configuration']['welcome_text'] = [
            '#type' => 'textfield',
            '#title' => t('Welcome text'),
            '#required' => TRUE,
            '#description' => $this->t('Text for welcome text appear at the header top navigation.'),
            '#default_value' => $this->get('welcome_text'),
            '#translatable' => TRUE,
        ];

        $form['header_configuration']['product_menu_new_tag'] = [
            '#type' => 'textfield',
            '#title' => t('New Tag'),
            '#required' => TRUE,
            '#description' => $this->t('Text for new tag'),
            '#default_value' => $this->get('product_menu_new_tag'),
            '#translatable' => TRUE,
        ];

        $form['header_configuration']['help_tooltip'] = [
            '#type' => 'textfield',
            '#title' => t('Help Tooltip'),
            '#required' => TRUE,
            '#description' => $this->t('Tooltip for help'),
            '#default_value' => $this->get('help_tooltip'),
            '#translatable' => TRUE,
        ];

        $form['header_configuration']['error_mid_down'] = [
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
     * Function to show generic tab configuration
     */
    private function genericSection(array &$form) {
        $form['field_labels_generic_configuration'] = [
            '#type' => 'details',
            '#title' => 'Generic Configuration',
            '#open' => False,
            '#group' => 'profile',
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

        $form['field_labels_generic_configuration']['my_profile_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('My Profile Tab Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('my_profile_tab'),
            '#translatable' => true,
            '#description' => 'Label for My Profile Tab.'
        ];

        $form['field_labels_generic_configuration']['change_password_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Change Password Tab label'),
            '#required' => TRUE,
            '#default_value' => $this->get('change_password_tab'),
            '#translatable' => true,
            '#description' => 'Label for Change Password Tab.'
        ];
    }

    /**
     * Contact Preference section configuration
     */
    private function contactPreferenceSection(array &$form) {
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
    }

    /**
     * Country mapping section configuration
     */
    private function countryMappingSection(array &$form) {
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
    }

    /**
     * Modal preview section configuration
     */
    private function modalPreviewSection(array &$form) {
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
    }

    /**
     * Validation Configuration Section
     */
    private function validationConfigurationSection(array &$form) {
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
    }

    /**
     * Mobile number section
     */
    private function mobileNumberSection(array &$form) {
        $form['mobile_number_config'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number Annotation',
            '#open' => false,
            '#group' => 'profile',
        ];

        $form['mobile_number_config']['enable_mobile_number_annotation'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Mobile Number Annotation'),
            '#required' => false,
            '#description' => $this->t('Enable annotation in mobile number field'),
            '#default_value' => $this->get('enable_mobile_number_annotation') ?? true,
            '#translatable' => true,
        ];
    }

    /**
     * SMS Configuration Section
     */
    private function smsConfigurationSection(array &$form) {
        $form['sms_configuration'] = [
            '#type' => 'details',
            '#title' => 'SMS Verification Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['sms_configuration']['enable_sms_verification'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable SMS Verification'),
            '#required' => FALSE,
            '#description' => $this->t('SMS Verification Feature Toggling'),
            '#default_value' => $this->get('enable_sms_verification') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['verify_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Verify Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for Verify Link'),
            '#default_value' => $this->get('verify_text'),
            '#translatable' => true,
        ];

        $form['sms_configuration']['modal_verify_header_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verify Header Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify text header'),
            '#default_value' => $this->get('modal_verify_header_text') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['modal_verify_body_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Verify Body Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify body text'),
            '#default_value' => $this->get('modal_verify_body_text') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['modal_verification_code_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verification Code Placeholder'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Placeholder text for verification field textfield'),
            '#default_value' => $this->get('modal_verification_code_placeholder') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['modal_verification_resend_code_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Resend Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for resend verification code'),
            '#default_value' => $this->get('modal_verification_resend_code_text') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['modal_verification_submit_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Submit Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for submit verification code'),
            '#default_value' => $this->get('modal_verification_submit_text') ?? '',
            '#translatable' => true,
        ];

        $form['sms_configuration']['verification_code_response'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Response from ICore'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Response from ICore'),
            '#default_value' => $this->get('verification_code_response') ?? '',
            '#translatable' => true,
        ];
    }

    /**
     * SMS Rate Limit Section configuration tab
     */
    private function smsRateLimitSection (array &$form) {
        $form['rate_limit_sms'] = [
            '#type' => 'details',
            '#title' => 'SMS Flood',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['rate_limit_sms']['rate_limit_sms_type'] = [
            '#type' => 'select',
            '#options' => [
                'user_mode' => $this->t('Username'),
                'ip_mode' => $this->t('IP'),
                'user_ip_mode' => $this->t('Username & IP'),
            ],
            '#title' => t('Rate Limit Type'),
            '#description' => $this->t('Rate limit by IP/Username/IP-Username'),
            '#default_value' => $this->get('rate_limit_sms_type') ?? 'user_mode',
        ];

        $form['rate_limit_sms']['rate_limit_sms_interval'] = [
            '#type' => 'textfield',
            '#title' => t('Interval'),
            '#description' => $this->t('Rate limit interval in seconds'),
            '#default_value' => $this->get('rate_limit_sms_interval') ?? 60,
        ];

        $form['rate_limit_sms']['rate_limit_sms_operation'] = [
            '#type' => 'textfield',
            '#title' => t('Rate Limit Operation'),
            '#description' => $this->t('Allowed Request'),
            '#default_value' => $this->get('rate_limit_sms_operation') ?? 1,
        ];

        $form['rate_limit_sms']['rate_limit_sms_error_message'] = [
            '#type' => 'textfield',
            '#title' => t('Rate Limit Error Message'),
            '#description' => $this->t('The message to display when the rate limit is exceeded'),
            '#default_value' => $this->get('rate_limit_sms_error_message') ?? 'You have exceeded the maximum number of SMS requests. Please try again later.',
            '#translatable' => TRUE,
        ];
    }

  /**
   * Password checklist form
   */
  private function passwordChecklistConfiguration(&$form)
  {
    $form['field_password_validation_box'] = [
      '#type' => 'details',
      '#title' => 'Password Validation Box',
      '#group' => 'my_account_group',
    ];

    $form['field_password_validation_box']['enable_new_password_validation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable New password validation'),
      '#description' => $this->t('If we check this checkbox new password validation will be active.'),
      '#default_value' => $this->get('enable_new_password_validation'),
      '#translatable' => true
    ];
  }
}
