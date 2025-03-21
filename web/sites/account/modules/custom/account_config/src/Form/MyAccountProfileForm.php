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
 *     "path" = "/admin/config/my-account/general",
 *   },
 *   menu = {
 *     "title" = "Profile Form Configuration",
 *     "description" = "Profile Form Configuration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class MyAccountProfileForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['my_account_config.general_configuration'];
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

        $this->featureConfig($form);
        $this->headerConfig($form);
        $this->genericConfig($form);
        $this->contactConfig($form);
        $this->mappingConfig($form);
        $this->modalConfig($form);
        $this->validationConfig($form);
        $this->smsConfig($form);
        $this->accessDeniedConfig($form);
        $this->helpConfig($form);
        $this->fastRegConfig($form);

        return $form;
    }

    private function featureConfig(&$form)
    {
        $form['feature_configuration'] = [
            '#type' => 'details',
            '#title' => 'Feature Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['feature_configuration']['enabled'] = [
            '#type' => 'checkbox',
            '#title' => t('Enable Profile Form Configuration'),
            '#description' => $this->t('Enable Profile Form Configuration'),
            '#default_value' => $this->get('enabled'),
            '#translatable' => TRUE,
        ];
    }

    private function headerConfig(&$form)
    {
        $form['header_configuration'] = [
            '#type' => 'details',
            '#title' => 'Header Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['header_configuration']['mp_page_title'] = [
            '#type' => 'textfield',
            '#title' => t('Page title'),
            '#required' => TRUE,
            '#description' => $this->t('Page title shown on the browser tab.'),
            '#default_value' => $this->get('mp_page_title'),
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

    private function genericConfig(&$form)
    {
        $form['field_labels_generic_configuration'] = [
            '#type' => 'details',
            '#title' => 'Generic Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_generic_configuration']['enable_mobile_number_annotation'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Mobile Number Annotation'),
            '#required' => TRUE,
            '#default_value' => $this->get('enable_mobile_number_annotation'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['my_profile_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for My Profile Tab'),
            '#required' => TRUE,
            '#default_value' => $this->get('my_profile_tab'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['change_password_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for Change Password Tab'),
            '#required' => TRUE,
            '#default_value' => $this->get('change_password_tab'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['documents_tab'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Label for Documents Tab'),
          '#required' => TRUE,
          '#default_value' => $this->get('documents_tab'),
          '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['primary_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for primary mobile number'),
            '#required' => TRUE,
            '#default_value' => $this->get('primary_label'),
            '#translatable' => TRUE,
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

        $form['field_labels_generic_configuration']['message_timeout'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Maximum timeout in second to display the Success/Error message.'),
            '#required' => TRUE,
            '#default_value' => $this->get('message_timeout'),
            '#translatable' => TRUE,
        ];
    }

    private function contactConfig(&$form)
    {
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

    private function mappingConfig(&$form)
    {
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

    private function modalConfig(&$form)
    {
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

        $form['field_labels_modal_preview']['modal_preview_btn'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Button Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_btn'),
            '#translatable' => true,
        ];
    }

    private function validationConfig(&$form)
    {
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

        $form['field_labels_validation_configuration']['password_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Min Length Error Message'),
            '#required' => true,
            '#default_value' => $this->get('password_min_length_validation'),
            '#translatable' => true,
        ];

        $form['field_labels_validation_configuration']['password_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Max Length Error Message'),
            '#required' => true,
            '#default_value' => $this->get('password_max_length_validation'),
            '#translatable' => true,
        ];
    }

    private function smsConfig(&$form)
    {
        $form['field_labels_sms_verification'] = [
            '#type' => 'details',
            '#title' => 'SMS Verification',
            '#open' => false,
            '#group' => 'profile',
        ];

        $form['field_labels_sms_verification']['enable_sms_verification'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable SMS Verification'),
            '#required' => false,
            '#description' => $this->t('SMS Verification Feature Toggling'),
            '#default_value' => $this->get('enable_sms_verification'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verify_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Verify Text'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Text for Verify Link'),
            '#default_value' => $this->get('verify_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verify_header_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verify Header Text'),
            '#required' => true,
            '#description' => $this->t('Text modal verify text header'),
            '#default_value' => $this->get('modal_verify_header_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verify_body_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Verify Body Text'),
            '#required' => true,
            '#description' => $this->t('Text modal verify body text'),
            '#default_value' => $this->get('modal_verify_body_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verification_code_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verification Code Placeholder'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Placeholder text for verification field textfield'),
            '#default_value' => $this->get('modal_verification_code_placeholder'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verification_resend_code_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Resend Verification Code Text'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Text for resend verification code'),
            '#default_value' => $this->get('modal_verification_resend_code_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['modal_verification_submit_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Submit Verification Code Text'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Text for submit verification code'),
            '#default_value' => $this->get('modal_verification_submit_text'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_response'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Response from ICore'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Response from ICore'),
            '#default_value' => $this->get('verification_code_response'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_required_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Field Error Message'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Required Field Error Message'),
            '#default_value' => $this->get('verification_code_required_message'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_numeric_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Numeric Error Message'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Numeric Field Error Message'),
            '#default_value' => $this->get('verification_code_numeric_message'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_min_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Min Length Field Error Message'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Min Length Field Error Message'),
            '#default_value' => $this->get('verification_code_min_length_message'),
            '#translatable' => true,
        ];

        $form['field_labels_sms_verification']['verification_code_max_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Max Length Field Error Message'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Max Length Field Error Message'),
            '#default_value' => $this->get('verification_code_max_length_message'),
            '#translatable' => true,
        ];
    }

    private function helpConfig(&$form)
    {
                //help config
                $form['help_configuration'] = [
                    '#type' => 'details',
                    '#title' => 'Help Configuration',
                    '#open' => false,
                    '#group' => 'profile',
                ];

                $howTo = $this->get('help_how_to');
                $form['help_configuration']['help_how_to'] = [
                    '#type' => 'text_format',
                    '#title' => t('How To'),
                    '#required' => true,
                    '#default_value' => $howTo['value'],
                    '#format' => $howTo['format'],
                    '#translatable' => true,
                ];

                $faq = $this->get('help_faq');
                $form['help_configuration']['help_faq'] = [
                    '#type' => 'text_format',
                    '#title' => t('FAQ'),
                    '#required' => true,
                    '#default_value' => $faq['value'],
                    '#format' => $faq['format'],
                    '#translatable' => true,
                ];

                $errorCode = $this->get('help_error_code');
                $form['help_configuration']['help_error_code'] = [
                    '#type' => 'text_format',
                    '#title' => t('Error Code'),
                    '#required' => true,
                    '#default_value' => $errorCode['value'],
                    '#format' => $errorCode['format'],
                    '#translatable' => true,
                ];
    }

    private function accessDeniedConfig(&$form)
    {
        $form['access_denied'] = [
            '#title' => 'Access Denied',
            '#group' => 'access_denied',
            '#type' => 'details',
            '#open' => false,
            '#group' => 'profile',
        ];

        $form['access_denied']['top_blurb'] = [
            '#type' => 'textarea',
            '#title' => t('Top Blurb'),
            '#required' => true,
            '#description' => $this->t('Top Blurb'),
            '#default_value' => $this->get('top_blurb'),
            '#translatable' => true,
        ];

        $form['access_denied']['bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => t('Bottom Blurb'),
            '#required' => true,
            '#description' => $this->t('Bottom Blurb'),
            '#default_value' => $this->get('bottom_blurb'),
            '#translatable' => true,
        ];
    }

    private function fastRegConfig(&$form)
    {
        $form['profile_form_fastreg_config'] = [
            '#type' => 'details',
            '#title' => 'Fast Reg Configuration',
            '#group' => 'profile',
        ];

        $form['profile_form_fastreg_config']['fastreg_timeout_redirect'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Timeout Redirect'),
            '#required' => TRUE,
            '#default_value' => $this->get('fastreg_timeout_redirect'),
            '#translatable' => true,
            '#description' => '<strong>[Fast Reg] </strong> Timeout in second(s) before player redirected back to Cashier.'
        ];

        $form['profile_form_fastreg_config']['fastreg_redirect'] = [
            '#type' => 'textfield',
            '#title' => $this->t('[Desktop] - Redirect To'),
            '#default_value' => $this->get('fastreg_redirect'),
            '#required' => TRUE,
            '#translatable' => TRUE,
            '#description' => '<strong>[Fast Reg] - </strong>redirect URL for Desktop'
        ];

        $form['profile_form_fastreg_config']['fastreg_mobile_redirect'] = [
            '#type' => 'textfield',
            '#title' => $this->t('[Mobile] - Redirect To'),
            '#default_value' => $this->get('fastreg_mobile_redirect'),
            '#required' => TRUE,
            '#translatable' => TRUE,
            '#description' => '<strong>[Fast Reg] - </strong>redirect URL for Mobile'
        ];

        $form['profile_form_fastreg_config']['fast_reg_flash_message'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Notification message'),
            '#default_value' => $this->get('fast_reg_flash_message')['value'] ?? '',
            '#format' => $content['format'] ?? 'full_html',
            '#required' => TRUE,
            '#translatable' => TRUE,
            '#description' => '<strong>[Fast Reg] </strong> Message to be displayed to update First Name and Last Name.'
        ];
    }
}
