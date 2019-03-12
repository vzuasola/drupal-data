<?php

namespace Drupal\zipang_desktop_blocks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ZipangDesktopBlockSettingsForm.
 *
 * @ingroup zipang_desktop_blocks
 */
class ZipangDesktopBlockSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'zipangdesktopblock_settings';
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
   * Defines the settings form for Zipang desktop block entities.
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
    $form['zipangdesktopblock_settings']['#markup']
      = 'Settings form for Zipang desktop block entities. Manage field settings here.';
    return $form;
  }

}
