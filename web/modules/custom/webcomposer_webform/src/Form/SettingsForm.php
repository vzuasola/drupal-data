<?php

namespace Drupal\webcomposer_webform\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

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

    // put the form side by side
    $form['general_settings']['#weight'] = -10;
    $form['third_party_settings']['#weight'] = -5;

    // Layout settings

    $configs = $settings->getThirdPartySetting('webcomposer_webform', 'webcomposer_webform_layout');

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_layout'] = [
      '#type' => 'details',
      '#title' => t('Layout Settings'),
      '#collapsed' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_layout']['label_font_color'] = [
      '#type' => 'color',
      '#title' => t('Label Font Color'),
      '#description' => t('The color of the field labels'),
      '#default_value' => $configs['label_font_color'] ?? '#000000',
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_layout']['error_font_color'] = [
      '#type' => 'color',
      '#title' => t('Error Font Color'),
      '#description' => t('The color of the error labels'),
      '#default_value' => $configs['error_font_color'] ?? '#ff0000',
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_layout']['header_markup'] = [
      '#type' => 'text_format',
      '#title' => t('Header Markup'),
      '#description' => t('An optional markup to show as the form header'),
      '#default_value' => $configs['header_markup']['value'] ?? NULL,
      '#format' => $configs['header_markup']['format'] ?? NULL,
    ];

    // Submission Layout settings

    $configs = $settings->getThirdPartySetting('webcomposer_webform', 'webcomposer_webform_submission_layout');

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_submission_layout'] = [
      '#type' => 'details',
      '#title' => t('Submission Layout Settings'),
      '#collapsed' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_submission_layout']['success_font_color'] = [
      '#type' => 'color',
      '#title' => t('Success Font Color'),
      '#description' => t('The color of the text for success message'),
      '#default_value' => $configs['success_font_color'] ?? '#ffffff',
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_submission_layout']['success_background_color'] = [
      '#type' => 'color',
      '#title' => t('Success Background Color'),
      '#description' => t('The background color of the success message'),
      '#default_value' => $configs['success_background_color'] ?? '#008000',
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_submission_layout']['error_font_color'] = [
      '#type' => 'color',
      '#title' => t('Error Font Color'),
      '#description' => t('The color of the error labels'),
      '#default_value' => $configs['error_font_color'] ?? '#ffffff',
    ];

    $form['third_party_settings']['webcomposer_webform']['webcomposer_webform_submission_layout']['error_background_color'] = [
      '#type' => 'color',
      '#title' => t('Error Background Color'),
      '#description' => t('The background color of the error message'),
      '#default_value' => $configs['error_background_color'] ?? '#ff0000',
    ];

    // Webform backgrounds

    $configs = $settings->getThirdPartySetting('webcomposer_webform', 'webform_background');

    $form['third_party_settings']['webcomposer_webform']['webform_background'] = [
      '#type' => 'details',
      '#title' => t('Background Settings'),
      '#open' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_background']['background_image'] = [
      '#type' => 'webform_image_file',
      '#title' => t('Default Form Background Image'),
      '#description' => t('The background image of the form'),
      '#default_value' => $configs['background_image'] ?? NULL,
      '#upload_location' => 'public://',
    ];

    // Translated backgrounds

    $form['third_party_settings']['webcomposer_webform']['webform_background']['translated'] = [
      '#type' => 'details',
      '#title' => t('Translated Backgrounds'),
      '#open' => FALSE,
      '#parents' => ['third_party_settings', 'webcomposer_webform', 'webform_background'],
    ];

    foreach ($this->languageManager->getLanguages() as $language) {
      $lang = $language->getId();

      if (isset($this->prefixes[$lang])) {
        $langKey = $this->prefixes[$lang];

        $form['third_party_settings']['webcomposer_webform']['webform_background']['translated']["background_image_$langKey"] = [
          '#type' => 'webform_image_file',
          '#title' => "Form Background Image for " . strtoupper($langKey) ,
          '#description' => t('The background image of the form'),
          '#default_value' => $configs["background_image_$langKey"] ?? NULL,
          '#upload_location' => 'public://',
        ];
      }
    }

    // SMS form

    $configs = $settings->getThirdPartySetting('webcomposer_webform', 'webform_sms');

    $form['third_party_settings']['webcomposer_webform']['webform_sms'] = [
      '#type' => 'details',
      '#title' => t('SMS Alert Settings'),
      '#open' => FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_sms']['sms'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable SMS Notification.'),
      '#default_value' => $configs['sms'] ?? FALSE,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_sms']['sms_message'] = [
      '#type' => 'textarea',
      '#title' => t('SMS Message'),
      '#maxlength' => 160,
      '#default_value' => $configs['sms_message'] ?? NULL,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_sms']['max_per_ip'] = [
      '#type' => 'number',
      '#title' => t('Maximum SMS per IP Address'),
      '#description' => t('The maximum number a unique IP address can opt-in for this day.'),
      '#maxlength' => 5,
      '#default_value' => $configs['max_per_ip'] ?? NULL,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_sms']['max_per_number'] = [
      '#type' => 'number',
      '#title' => t('Maximum SMS per Number'),
      '#description' => t('The maximum number a unique phone number can opt-in for this day.'),
      '#attributes' => array (
        'type' => 'number'
      ),
      '#maxlength' => 5,
      '#default_value' => $configs['max_per_number'] ?? NULL,
    ];

    $form['third_party_settings']['webcomposer_webform']['webform_sms']['sms_error'] = [
      '#type' => 'textfield',
      '#title' => t('Maximum SMS Reached Error Message'),
      '#description' => t('Error message when maximum SMS messages has been reached.'),
      '#default_value' => $configs['sms_error'] ?? NULL,
    ];

    $this->tweakForm($form);

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

    // remove translated backgrounds
    // foreach ($this->languageManager->getLanguages() as $language) {
    //   $lang = $language->getId();

    //   if (isset($this->prefixes[$lang])) {
    //     $langKey = $this->prefixes[$lang];

    //     if (!empty($third_party_settings['webcomposer_webform']['webform_background']["background_image_$langKey"])) {
    //       unset($third_party_settings['webcomposer_webform']['webform_background']["background_image_$langKey"]);
    //     }
    //   }
    // }

    $default_bg_fid = isset($form['third_party_settings']['webcomposer_webform']['webform_background']['background_image']['fids'])
    ? $form['third_party_settings']['webcomposer_webform']['webform_background']['background_image']['fids']['#value']
    : null;

    /* checking if fid is set
     * note fid will only set when there is an upload of the image
     * url = https://api.drupal.org/api/drupal
     * url/core%21modules%21file%21file.services.yml/service/file.usage/8.5.x
     * url/core%21modules%21file%21file.module/function/file_load/8.5.x
     */
    if ($default_bg_fid) {
      $file = File::load((int) $default_bg_fid[0]);
      $file->setPermanent();
      $file->save();
      $file_usage = \Drupal::service('file.usage');
      $file_usage->add($file, 'webcomposer_webform', 'image', $default_bg_fid[0]);
    }

    $form_state->setValue('third_party_settings', $third_party_settings);

  }

  /**
   * Tweak the form
   */
  private function tweakForm(&$form) {
    // Hide all fields except these

    $exclude = [
      'general_settings',
      'submission_limits',
      'third_party_settings',
      'confirmation_settings',
      'form_settings',
    ];

    foreach ($form as $key => $value) {
      if (!in_array($key, $exclude) && is_array($value)) {
        $form[$key]['#access'] = FALSE;
      }
    }

    // Form settings tweaks
    unset($form['form_settings']['status']['#options']['scheduled']);

    // confirmation tweaks
    $form['confirmation_settings']['confirmation_type']['#default_value'] = 'page';
    $form['confirmation_settings']['confirmation_type']['#access'] = FALSE;
    $form['confirmation_settings']['confirmation_url']['#access'] = FALSE;
    $form['confirmation_settings']['confirmation_title']['#access'] = FALSE;
    $form['confirmation_settings']['confirmation_page']['#access'] = FALSE;

    // submission tweaks
    $form['submission_limits']['limit_user']['#access'] = FALSE;
    $form['submission_limits']['entity_limit_user']['#access'] = FALSE;
    $form['submission_limits']['limit_user_message']['#access'] = FALSE;

    // put the form side by side
    $form['general_settings']['#weight'] = -10;
    $form['third_party_settings']['#weight'] = -5;
  }
}
