<?php

namespace Drupal\myaccount_profile\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Site\Settings;

/**
 * Configure form error settings for this site.
 */
class MyAccountProfileSettings extends ConfigFormBase {

  /**
   * Gets the form identifier.
   *
   * @return <string> The form identifier.
   */
  public function getFormId() {
    return 'myaccount.my_profile_config';
  }

  /**
   * Gets the editable configuration names.
   *
   * @return array  The editable configuration names.
   */
  protected function getEditableConfigNames() {
    return [
      'myaccount_profile.my_profile',
    ];
  }

  /**
   * Builds a form.
   *
   * @param array                                 $form        The form
   * @param  \Drupal\Core\Form\FormStateInterface  $form_state  The form state
   *
   * @return <type>                                The form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('myaccount_profile.my_profile');

    $form[] = self::buildConfigurationForm($config);

    return parent::buildForm($form, $form_state);

  }

  /**
   * Form submit
   *
   * @param array                                 $form        The form
   * @param \Drupal\Core\Form\FormStateInterface  $form_state  The form state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    self::getConfigurationFormValues($config, $values);

    parent::submitForm($form, $form_state);

  }


  /**
   * Creates the form for labels configuration.
   *
   * @param array $config
   *   An array of configuration settings for email template.
   *
   * @return form
   *   Array of form variable
   */
  public function buildConfigurationForm($config) {

 // Vertical tab creation.
    $form['language'] = array(
      '#type' => 'vertical_tabs',
    );

    $form['field_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('Fields configuration'),
      '#collapsible' => TRUE,
      '#group' => 'language',
      '#weight' => 50,
    );

    $form['field_config']['field_firstname'] = array(
      '#type' => 'details',
      '#title' => $this->t('Firstname'),
      '#collapsible' => TRUE,
    );
    $form['field_config']['field_lastname'] = array(
      '#type' => 'details',
      '#title' => $this->t('Lastname'),
      '#collapsible' => TRUE,
    );

    // Label form fields goes below this.
    $form['field_config']['field_firstname']['firstname_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for title.'),
      '#default_value' => $config->get('firstname_title'),
    );

    $form['field_config']['field_lastname']['lastname_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for title.'),
      '#default_value' => $config->get('lastname_title'),
    );

     $form['error_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('Error configuration'),
      '#collapsible' => TRUE,
      '#group' => 'language',
      '#weight' => 50,
    );

    $form['error_config']['application_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('Application Config'),
      '#collapsible' => TRUE,
     );


    $form['error_config']['Icore_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('Icore Config'),
      '#collapsible' => TRUE,
     );

    return $form;

  }

  /**
   * Retrieves the form values entered for  config for both language.
   *
   *   Saves form values for both English & Japanese language.
   *
   * @param array $config
   *   An array of configuration settings for email template form.
   * @param array $values
   *   An array of submitted form values.
   */
  public function getConfigurationFormValues($config, $values) {
    // For saving the configurations.
    $this->config('myaccount_profile.my_profile')
      ->set('lastname_title', $values['lastname_title'])
      ->set('firstname_title', $values['firstname_title'])

      ->save();
  }

}
