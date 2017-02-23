<?php

namespace Drupal\my_account\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class ChangePassword extends FormBase {

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['change_password'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_labels'] = [
      '#type' => 'details',
      '#title' => 'Field Labels',
      '#group' => 'change_password',
    ];

    $form['field_labels']['current_password'] = [
      '#type' => 'textfield',
      '#title' => t('Current Password'),
    ];

    $form['field_labels']['new_password'] = [
      '#type' => 'textfield',
      '#title' => t('New Password'),
    ];


    $form['field_labels']['confirm_password'] = [
      '#type' => 'textfield',
      '#title' => t('Confirm Password'),
    ];

    $form['validation'] = [
      '#type' => 'details',
      '#title' => t('Validation'),
      '#group' => 'change_password',
    ];

    $form['validation']['required'] = [
      '#title' => t('Required?'),
      '#type' => 'details',
      '#open' => true
    ];

    $form['validation']['required']['old_password'] = [
      '#title' => t('Required?'),
      '#type' => 'checkbox'
    ];

    $form['validation']['old_password']['new_password'] = [
      '#title' => t('Error Message'),
      '#type' => 'textfield'
    ];

    $form['actions'] = ['#type' => 'actions'];
    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'fapi_change_password_config';
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Find out what was submitted.
    $values = $form_state->getValues();

    foreach ($values as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // Many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) {
        $value = array_filter($value);
      }
      // Only display for controls that have titles and values.
      if ($value) {
        $display_value = is_array($value) ? print_r($value, 1) : $value;
        $message = $this->t('Value for %title: %value', ['%title' => $label, '%value' => $display_value]);
        drupal_set_message($message);
      }
    }
  }

}
