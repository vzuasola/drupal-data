<?php

namespace Drupal\webcomposer_webform\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Form for adding additional webform settings element
 */
class SettingsForm {
  /**
   * 
   */
  public function getForm(&$form, FormStateInterface $form_state) {
    $settings = $form_state->getFormObject()->getEntity();

    // Hide all fields except these
    $exclude = ['general_settings', 'submission_limits', 'third_party_settings'];

    foreach ($form as $key => $value) {
      if (!in_array($key, $exclude) && is_array($value)) {
        $form[$key]['#access'] = FALSE;
      }
    }

    // put the form side by side
    $form['general_settings']['#weight'] = -10;
    $form['third_party_settings']['#weight'] = -5;

    // Layout settings
    $form['third_party_settings']['webcomposer_webform'] = [
      '#type' => 'details',
      '#title' => t('Layout Settings'),
      '#collapsed' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['label_font_color'] = [
      '#type' => 'color',
      '#title' => t('Label Font Color'),
      '#description' => t('The color of the field labels'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform', 'label_font_color', '#000000'),
    ];

    $form['third_party_settings']['webcomposer_webform']['error_font_color'] = [
      '#type' => 'color',
      '#title' => t('Error Font Color'),
      '#description' => t('The color of the error labels'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform', 'error_font_color', '#ff0000'),
    ];

    $d = $settings->getThirdPartySetting('webcomposer_webform', 'header_markup');

    $form['third_party_settings']['webcomposer_webform']['header_markup'] = [
      '#type' => 'text_format',
      '#title' => t('Header Markup'),
      '#description' => t('An optional markup to show as the form header'),
      '#default_value' => $d['value'] ?? NULL,
      '#format' => $d['format'] ?? NULL,
    ];

    // Submission settings
    $form['third_party_settings']['webcomposer_webform_submission'] = [
      '#type' => 'details',
      '#title' => t('Submission Settings'),
      '#collapsed' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform_submission']['submission_status'] = [
      '#type' => 'radios',
      '#title' => t('Submission Status'),
      '#description' => t('The status for this form submission'),
      '#options' => [
        'open' => 'Open',
        'close' => 'Closed',
      ],
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission', 'submission_status', 'open'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission']['successful_submission_message'] = [
      '#type' => 'textarea',
      '#title' => t('Successful Submission Message'),
      '#description' => t('Message to show when the submission is successful'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission', 'successful_submission_message'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission']['closed_submission_message'] = [
      '#type' => 'textarea',
      '#title' => t('Closed Submission Message'),
      '#description' => t('Message to show when the submission is closed'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission', 'closed_submission_message'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission']['failed_submission_message'] = [
      '#type' => 'textarea',
      '#title' => t('Failed Submission Message'),
      '#description' => t('Message to show when the submission is failed'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission', 'failed_submission_message'),
    ];

    // Submission Layout settings
    $form['third_party_settings']['webcomposer_webform_submission_layout'] = [
      '#type' => 'details',
      '#title' => t('Submission Layout Settings'),
      '#collapsed' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform_submission_layout']['success_font_color'] = [
      '#type' => 'color',
      '#title' => t('Success Font Color'),
      '#description' => t('The color of the text for success message'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission_layout', 'success_font_color', '#ffffff'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission_layout']['success_background_color'] = [
      '#type' => 'color',
      '#title' => t('Success Background Color'),
      '#description' => t('The background color of the success message'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission_layout', 'success_background_color', '#008000'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission_layout']['error_font_color'] = [
      '#type' => 'color',
      '#title' => t('Error Font Color'),
      '#description' => t('The color of the error labels'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission_layout', 'error_font_color', '#ffffff'),
    ];

    $form['third_party_settings']['webcomposer_webform_submission_layout']['error_background_color'] = [
      '#type' => 'color',
      '#title' => t('Error Background Color'),
      '#description' => t('The background color of the error message'),
      '#default_value' => $settings->getThirdPartySetting('webcomposer_webform_submission_layout', 'error_background_color', '#ff0000'),
    ];

    // TODO Make this dynamic by looping on the available language instead
    // Also add a default fallback
    $form['third_party_settings']['webform_background'] = [
      '#type' => 'details',
      '#title' => t('Background Settings'),
      '#open' => FALSE,
    ];

    $form['third_party_settings']['webform_background']['background_image_en'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image EN'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_en'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_sc'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image SC'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_sc'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_ch'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image CH'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_ch'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_eu'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image EU'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_eu'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_th'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image TH'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_th'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_vn'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image VN'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_vn'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_in'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image IN'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_in'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_jp'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image JP'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_jp'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_kr'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image KR'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_kr'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_id'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image ID'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_id'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_gr'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image GR'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_gr'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['third_party_settings']['webform_background']['background_image_pl'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Form Background Image PL'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image_pl'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    $form['#validate'][] = [$this, 'validate'];
  }

  /**
   * 
   */
  public function validate(&$form, FormStateInterface $form_state) {
    $settings = $form_state->getFormObject()->getEntity();

    // fix for image uploads breaking due to unknown reasons that the scheduled date
    // gets validated on image upload AJAX calls
    $date = $settings->get('open')['date'];
    if (!$date) {
      $settings->set('open', FALSE);
    }

    $date = $settings->get('close')['date'];
    if (!$date) {
      $settings->set('close', FALSE);
    }

    // remove the background image upload on empty background
    $third_party_settings = $form_state->getValue('third_party_settings');

    if (empty($third_party_settings['webform_background']['background_image_en'])) {
      unset($third_party_settings['webform_background']['background_image_en']);
    }
    if (empty($third_party_settings['webform_background']['background_image_sc'])) {
      unset($third_party_settings['webform_background']['background_image_sc']);
    }
    if (empty($third_party_settings['webform_background']['background_image_ch'])) {
      unset($third_party_settings['webform_background']['background_image_ch']);
    }
    if (empty($third_party_settings['webform_background']['background_image_eu'])) {
      unset($third_party_settings['webform_background']['background_image_eu']);
    }
    if (empty($third_party_settings['webform_background']['background_image_th'])) {
      unset($third_party_settings['webform_background']['background_image_th']);
    }
    if (empty($third_party_settings['webform_background']['background_image_vn'])) {
      unset($third_party_settings['webform_background']['background_image_vn']);
    }
    if (empty($third_party_settings['webform_background']['background_image_in'])) {
      unset($third_party_settings['webform_background']['background_image_in']);
    }
    if (empty($third_party_settings['webform_background']['background_image_jp'])) {
      unset($third_party_settings['webform_background']['background_image_jp']);
    }
    if (empty($third_party_settings['webform_background']['background_image_kr'])) {
      unset($third_party_settings['webform_background']['background_image_kr']);
    }
    if (empty($third_party_settings['webform_background']['background_image_id'])) {
      unset($third_party_settings['webform_background']['background_image_id']);
    }
    if (empty($third_party_settings['webform_background']['background_image_gr'])) {
      unset($third_party_settings['webform_background']['background_image_gr']);
    }
    if (empty($third_party_settings['webform_background']['background_image_pl'])) {
      unset($third_party_settings['webform_background']['background_image_pl']);
    }

    $form_state->setValue('third_party_settings', $third_party_settings);
  }
}
