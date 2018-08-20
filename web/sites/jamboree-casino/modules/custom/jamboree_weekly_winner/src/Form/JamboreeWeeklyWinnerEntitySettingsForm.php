<?php

namespace Drupal\jamboree_weekly_winner\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class JamboreeWeeklyWinnerEntitySettingsForm.
 *
 * @ingroup jamboree_weekly_winner
 */
class JamboreeWeeklyWinnerEntitySettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'jamboreeweeklywinnerentity_settings';
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
   * Defines the settings form for Jamboree weekly winner entity entities.
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
    $form['jamboreeweeklywinnerentity_settings']['#markup'] = 'Settings form for Jamboree weekly winner entity entities. Manage field settings here.';
    return $form;
  }

}
