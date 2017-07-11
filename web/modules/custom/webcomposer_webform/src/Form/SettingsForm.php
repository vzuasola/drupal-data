<?php

namespace Drupal\webcomposer_webform\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Form for adding additional webform settings element
 */
class SettingsForm {
  /**
   * Language manager
   */
  private $languageManager;

  /**
   * Language prefixes
   */
  private $prefixes;

  /**
   * Constructor
   */
  public function __construct() {
    $this->languageManager = \Drupal::service('language_manager');
    $this->prefixes = \Drupal::config('language.negotiation')->get('url.prefixes');
  }

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

    $form['submission_limits']['limit_user']['#access'] = FALSE;
    $form['submission_limits']['entity_limit_user']['#access'] = FALSE;
    $form['submission_limits']['limit_user_message']['#access'] = FALSE;

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

    $form['third_party_settings']['webform_background'] = [
      '#type' => 'details',
      '#title' => t('Background Settings'),
      '#open' => FALSE,
    ];

    $form['third_party_settings']['webform_background']['background_image'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Default Form Background Image'),
      '#description' => t('The background image of the form'),
      '#default_value' => $settings->getThirdPartySetting('webform_background', 'background_image'),
      '#upload_location' => 'public://webform-backgrounds',
    ];

    // translated backgrounds

    $form['third_party_settings']['webform_background']['translated'] = [
      '#type' => 'details',
      '#title' => t('Translated Backgrounds'),
      '#open' => FALSE,
      '#parents' => ['third_party_settings', 'webform_background'],
    ];

    foreach ($this->languageManager->getLanguages() as $language) {
      $lang = $language->getId();

      if (isset($this->prefixes[$lang])) {
        $langKey = $this->prefixes[$lang];

        $form['third_party_settings']['webform_background']['translated']["background_image_$langKey"] = [
          '#type' => 'webform_image_file',
          '#title' => "Form Background Image for " . strtoupper($langKey) ,
          '#description' => t('The background image of the form'),
          '#default_value' => $settings->getThirdPartySetting('webform_background', "background_image_$langKey"),
          '#upload_location' => 'public://webform-backgrounds',
        ];
      }
    }

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

    // always mark this form as open
    $form_state->setValue('status', 'open');

    // remove the background image upload on empty background
    $third_party_settings = $form_state->getValue('third_party_settings');

    // remove translated backgrounds
    foreach ($this->languageManager->getLanguages() as $language) {
      $lang = $language->getId();

      if (isset($this->prefixes[$lang])) {
        $langKey = $this->prefixes[$lang];

        if (empty($third_party_settings['webform_background']["background_image_$langKey"])) {
          unset($third_party_settings['webform_background']["background_image_$langKey"]);
        }
      }
    }

    $form_state->setValue('third_party_settings', $third_party_settings);
  }
}
