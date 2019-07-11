<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LeftFloatingBannerEntitySettingsForm.
 *
 * @package Drupal\webcomposer_floating_banners\Form
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntitySettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'LeftFloatingBannerEntity_settings';
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
   * Defines the settings form for Left floating banner entity entities.
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
    $form['LeftFloatingBannerEntity_settings']['#markup'] = 'Settings form for Floating Banner entities. Manage field settings here.';
    return $form;
  }

}
