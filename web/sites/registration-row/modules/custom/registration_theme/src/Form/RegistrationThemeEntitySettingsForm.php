<?php

namespace Drupal\registration_theme\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RegistrationThemeEntitySettingsForm.
 *
 * @ingroup registration_theme
 */
class RegistrationThemeEntitySettingsForm extends FormBase {

  const SETTINGS_DESCRIPTION = 'Settings form for Registration theme entity entities. Manage field settings here.';

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'registrationthemeentity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * Defines the settings form for Registration theme entity entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['registrationthemeentity_settings']['#markup'] = self::SETTINGS_DESCRIPTION;
    return $form;
  }

}
