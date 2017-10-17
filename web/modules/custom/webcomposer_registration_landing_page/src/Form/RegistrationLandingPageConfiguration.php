<?php

namespace Drupal\webcomposer_registration_landing_page\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Registration step2 configuration class
 */
class RegistrationLandingPageConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'registration_landing_page_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.registration_landing_page_configuration'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get Form configuration.
    $config = $this->config('webcomposer_config.registration_landing_page_configuration');
    $form['registration_landing_page'] = array(
        '#type' => 'vertical_tabs',
    );

    $form['field_configuration'] = array(
      '#type' => 'details',
      '#title' => 'Global Configuration',
      '#group' => 'registration_landing_page'
    );

    $content = $config->get('registration_content');

    $form['field_configuration']['registration_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Registration Landing Page Content'),
        '#default_value' => $content['value'],
        '#format' => $content['format'],
        '#required' => TRUE,
    );

    $form['field_configuration']['registration_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Registration Landing Page Title'),
      '#description' => $this->t('Registration Landing Page Title'),
      '#size' => 255,
      '#default_value' => $config->get('registration_title')
    );

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save')
    ];

    return $form;
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
    $keys = array(
      'registration_content',
      'registration_title'
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_config.registration_landing_page_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }
}
