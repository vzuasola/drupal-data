<?php

namespace Drupal\desktop_game_collection\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ClassDesktopGameCollectionSettingsForm.
 *
 * @ingroupdesktop_game_collection
 */
class DesktopGameCollectionSettingsForm extends FormBase {  
  
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'desktopgamecollection_settings';
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
   * Defines the settings form forDesktop game collection entities.
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
    $form['desktopgamecollection_settings']['#markup'] = 'Settings form forDesktop game collection entities. Manage field settings here.';
    return $form;
  }
  
}
