<?php

namespace Drupal\zedbet_payments\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ZedbetPaymentSettingsForm.
 *
 * @ingroup zedbet_payments
 */
class ZedbetPaymentSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
    public function getFormId() {
        return 'zedbetpayment_settings';
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
     * Defines the settings form for Zedbet payment entities.
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
        $form['zedbetpayment_settings']['#markup'] = 'Settings form for Zedbet payment entities. Manage field settings here.';
        return $form;
    }
}
