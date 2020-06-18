<?php

namespace Drupal\registration_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration for Registration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "registration_general_config",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/registration/general",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "General Configuration for Registration",
 *     "parent" = "registration_config.list",
 *   },
 * )
 */
class GeneralConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['registration_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Settings'),
    ];

    $this->jpayIntegration($form);
    $this->errorConfig($form);

    return $form;
  }

  /**
   * Error Configuration for Registration.
   */
  private function errorConfig(array &$form) {
    $form['error_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Error Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];
    $form['error_settings']['generic_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Generic Form Error Message'),
      '#description' => $this->t('Generic error form message that will appear at the top of ' .
        'the form with appended error code on it. This will be used if there are unhandled ' .
        'exceptions on the form e.g unsupported currency on specific portal ID.'),
      '#default_value' => $this->get('generic_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['error_settings']['error_code_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Error Code Mapping'),
      '#description' => $this->t('Mapping of error codes returned by reg API, ' .
        'particularly the error codes returned by icore which cannot be handled by ' .
        'the registration form itself e.g ExternalPlayerAccountCreationFailed|-20. ' .
        'where ExternalPlayerAccountCreationFailed is the icore status code and -20 ' .
        'is the error code that will appear beside the generic error message'),
      '#default_value' => $this->get('error_code_mapping'),
      '#required' => TRUE,
    ];
    $form['error_settings']['unauthenticated_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unauthenticated Form Error Message'),
      '#description' => $this->t('Unauthenticated error form message that will appear at the top of ' .
        'the form if the player is not successfully authenticated after successful registration.'),
      '#default_value' => $this->get('unauthenticated_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['error_settings']['forbidden_request_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration API forbidden request error message'),
      '#default_value' => $this->get('forbidden_request_error_message'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * JPay Integration Config.
   */
  private function jpayIntegration(&$form) {
    $form['jpay_integration'] = [
      '#type' => 'details',
      '#title' => $this->t('JPay Integration'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['jpay_integration']['jpay_api'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPAY API Endpoint'),
      '#description' => $this->t('Endpoint for JPAY API'),
      '#default_value' => $this->get('jpay_api') ?? "http://cms-jpayws.games.prd/api/cashier/",
      '#translatable' => TRUE,
    ];

    $form['jpay_integration']['jpay_siteid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPay Site ID'),
      '#description' => $this->t('JPay Site ID for nextbet'),
      '#default_value' => $this->get('jpay_siteid') ?? 106,
      '#translatable' => TRUE,
    ];
  }
}
