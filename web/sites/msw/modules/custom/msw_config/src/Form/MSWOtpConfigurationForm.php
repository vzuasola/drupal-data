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
 *     "title" = "OTP Configuration",
 *     "path" = "/admin/config/msw/otp_configuration",
 *   },
 *   menu = {
 *     "title" = "OTP Configuration",
 *     "description" = "Provides OTP configuration",
 *     "parent" = "msw_config.list",
 *     "weight" = 10
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
            '#title' => t('OTP Configuration'),
        ];

        $this->sectionPageSetting($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form)
    {
        $form['otp_config'] = [
            '#type' => 'details',
            '#title' => $this->t('OTP Configuration'),
            '#group' => 'advanced',
        ];

        $form['otp_config']['otp_enable'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable OTP Feature'),
            '#description' => $this->t('Check to enable otp feature'),
            '#default_value' => $this->get('otp_enable'),
            '#translatable' => TRUE,
        ];

        $form['otp_config']['otp_popup_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Form Popup Header'),
            '#description' => $this->t('This will appear on OTP form lightbox header'),
            '#default_value' => $this->get('otp_popup_header') ?? 'Mobile Number Verification',
        ];

        $form['otp_config']['otp_blurb'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Blurb'),
            '#description' => $this->t('OTP Page Blurb'),
            '#default_value' => $this->get('otp_blurb') ?? 'Blurb text goes here',
        ];

        $form['otp_config']['otp_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('OTP Text'),
            '#description' => $this->t('This will be the OTP text above the OTP field input'),
            '#default_value' => $this->get('otp_text') ?? 'Enter your OTP code.',
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
    }
}
