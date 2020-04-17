<?php

namespace Drupal\mobile_sponsor_list_v2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MobileSponsorListv2SettingsForm.
 *
 * @ingroup mobile_sponsor_list_v2
 */
class MobileSponsorListv2SettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'mobile_sponsor_list_v2_settings';
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
   * Defines the settings form for Mobile Sponsor List version 2.0. entities.
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
    $form['mobile_sponsor_list_v2_settings']['#markup'] = 'Settings form for Mobile Sponsor List version 2.0. entities. Manage field settings here.';
    return $form;
  }

}
