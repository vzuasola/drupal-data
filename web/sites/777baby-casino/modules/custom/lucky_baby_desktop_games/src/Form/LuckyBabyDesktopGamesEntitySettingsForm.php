<?php

namespace Drupal\lucky_baby_desktop_games\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LuckyBabyDesktopGamesEntitySettingsForm.
 *
 * @ingroup lucky_baby_desktop_games
 */
class LuckyBabyDesktopGamesEntitySettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'luckybabydesktopgamesentity_settings';
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
   * Defines the settings form for Lucky baby desktop games entity entities.
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
    $form['luckybabydesktopgamesentity_settings']['#markup'] = 'Settings form for Lucky baby desktop games entity entities. Manage field settings here.';
    return $form;
  }

}
