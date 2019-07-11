<?php

namespace Drupal\webcomposer_right_side_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RightSideBlockEntitySettingsForm.
 *
 * @package Drupal\webcomposer_right_side_block\Form
 *
 * @ingroup webcomposer_right_side_block
 */
class RightSideBlockEntitySettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'RightSideBlockEntity_settings';
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
   * Defines the settings form for Inner Page Right Side Block entities.
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
    $form['RightSideBlockEntity_settings']['#markup'] = 'Settings form for Inner Page Right Side Block entities. Manage field settings here.';
    return $form;
  }

}
