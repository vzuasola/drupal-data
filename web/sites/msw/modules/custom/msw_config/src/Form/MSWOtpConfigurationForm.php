<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW Otp Configuration Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_otp_config_form",
 *   route = {
 *     "title" = "OTP and Security Questions Configuration",
 *     "path" = "/admin/config/msw/otp_configuration",
 *   },
 *   menu = {
 *     "title" = "OTP and Security Questions Configuration",
 *     "description" = "Provides OTP and Security Questions configuration",
 *     "parent" = "msw_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class MSWOtpConfigurationForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames()
    {
        return ['msw_config.otp_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state)
    {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('OTP Configurations'),
        ];

        $this->sectionPageSetting($form);
        $this->securityQuestionSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form)
    {
        $form['otp_config'] = [
            '#type' => 'details',
            '#title' => $this->t('OTP Configurations'),
            '#group' => 'advanced',
        ];

        $form['otp_config']['otp_popup_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Form Popup Header'),
            '#description' => $this->t('This will appear on OTP form lightbox header'),
            '#default_value' => $this->get('otp_popup_header') ?? 'Mobile Number Verification',
        ];

        $otp_blurb = $this->get('otp_blurb');
        $form['otp_config']['otp_blurb'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Content Blurb'),
          '#default_value' => $otp_blurb['value'] ?? '<p>Please enter the OTP sent to your phone number, or contact our Customer Support at <a href="/emailto: support@megasportsworld.com" style="color: #eb6123" target="_blank">support@megasportsworld.com</a> for any enquires</p>',
          '#format' => $otp_blurb['format'],
          '#translatable' => TRUE,
        ];

        $form['otp_config']['otp_field_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP input field placeholder'),
            '#description' => $this->t('This will be the OTP input field placeholder'),
            '#default_value' => $this->get('otp_field_placeholder') ?? '',
        ];

        $form['otp_config']['otp_submit_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Submit button text'),
            '#description' => $this->t('This will be the OTP submit button text'),
            '#default_value' => $this->get('otp_submit_button') ?? 'Submit',
        ];

        $form['otp_config']['otp_request_new_otp_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Request new otp button text'),
            '#description' => $this->t('This will be the request new otp button text'),
            '#default_value' => $this->get('otp_request_new_otp_button') ?? 'Request New OTP',
        ];

        $form['otp_config']['otp_cancel_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Cancel button text'),
            '#description' => $this->t('This will be the OTP cancel button text'),
            '#default_value' => $this->get('otp_cancel_button') ?? 'Cancel',
        ];

        $form['otp_config']['otp_success_request_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Success Request Message'),
            '#description' => $this->t('Message to display after a successful OTP request. ' .
                'Use the :mobile token and the script will replace it with the player mobile.'),
            '#default_value' => $this->get('otp_success_request_message') ?? 'OTP sent to your mobile number :mobile',
        ];

        $form['otp_config']['otp_error_code_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Registration and OTP error codes to status messages mapping'),
            '#description' => $this->t('Mapping of Registration RoW and OTP error codes ' .
                'to its status message e.g. "LimitReached|Daily OTP request limit reached."'),
            '#default_value' => $this->get('otp_error_code_mapping'),
            '#required' => TRUE,
        ];

        $form['otp_config']['otp_countdown_timer'] = [
            '#type' => 'number',
            '#title' => $this->t('OTP Resend Button - Countdown Timer'),
            '#description' => $this->t('Waiting time in-between OTP requests (in seconds)'),
            '#default_value' => $this->get('otp_countdown_timer') ?? 30,
        ];

        $form['otp_config']['otp_retries_limit'] = [
            '#type' => 'number',
            '#title' => $this->t('OTP Resend Button - Retries Limit'),
            '#description' => $this->t('Number of OTP requests allowed per day, per player'),
            '#default_value' => $this->get('otp_retries_limit') ?? 5,
        ];

        $form['otp_config']['otp_resend_button_freeze_time'] = [
            '#type' => 'number',
            '#title' => $this->t('OTP Resend Button - freeze time'),
            '#description' => $this->t('Number of seconds the Resend button to be freezed'),
            '#default_value' => $this->get('otp_resend_button_freeze_time') ?? 5,
        ];

        $form['otp_config']['otp_retry_limit_error_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Retries Limit Error Message'),
            '#description' => $this->t('Message to display after retries limit exceeded.'),
            '#default_value' => $this->get('otp_retry_limit_error_message') ?? 'You have reached maximum attempts',
        ];
    }

    /**
     * {@inheritdoc}
     */
    private function securityQuestionSetting(array &$form)
    {
        $form['security_config'] = [
            '#type' => 'details',
            '#title' => $this->t('Security Questions'),
            '#group' => 'advanced',
        ];

        $form['security_config']['security_question_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Security Question Header Title'),
            '#description' => $this->t('This will appear on Security Question lightbox header'),
            '#default_value' => $this->get('security_question_header') ?? 'Security Question',
        ];

        $form['security_config']['security_question_submit_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit button text'),
            '#description' => $this->t('Submit button text label'),
            '#default_value' => $this->get('security_question_submit_button') ?? 'Submit',
        ];

        $form['security_config']['security_question_cancel_button'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cancel button text'),
            '#description' => $this->t('Cancel button text label'),
            '#default_value' => $this->get('security_question_cancel_button') ?? 'Cancel',
        ];

        $form['security_config']['security_question_error_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Answer not correct error message'),
            '#description' => $this->t('Message to display when player provide not correct answer.'),
            '#default_value' => $this->get('security_question_error_message') ?? 'Invalid Password',
        ];

        $form['security_config']['security_question_max_attempts'] = [
            '#type' => 'number',
            '#title' => $this->t('Maximum count submissions failed attempts'),
            '#description' => $this->t('Count before player reached the maximum attempts.'),
            '#default_value' => $this->get('security_question_max_attempts') ?? 5,
        ];

        $form['security_config']['security_question_expiry_duration'] = [
            '#type' => 'number',
            '#title' => $this->t('Duration of player being locked'),
            '#description' => $this->t('Duration of player being locked out when reached the maximum failed attempts. (per/seconds)'),
            '#default_value' => $this->get('security_question_expiry_duration') ?? 60,
        ];

        $form['security_config']['security_question_max_attempts_msg'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Maximum submissions attempts reached'),
            '#description' => $this->t('Message to display when player reached the maximum failed attempts.'),
            '#default_value' => $this->get('security_question_max_attempts_msg') ?? 'Maximum attempts reached',
        ];

        $security_question_not_set = $this->get('security_question_not_set');
        $form['security_config']['security_question_not_set'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Security Question not set message'),
          '#default_value' => $security_question_not_set['value'] ?? '<p>Security Question has not been set for this account</p>',
          '#format' => $security_question_not_set['format'],
          '#translatable' => TRUE,
        ];
    }
}
