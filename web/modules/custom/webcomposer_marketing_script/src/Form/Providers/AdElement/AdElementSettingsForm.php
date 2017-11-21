<?php

namespace Drupal\webcomposer_marketing_script\Form\Providers\AdElement;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * AdElement Settings Class.
 */
class AdElementSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'MarketingScript_providers_adelement_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_marketing_script.providers_adelement_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get Form configuration.
    $config = $this->config('webcomposer_marketing_script.providers_adelement_settings');

    $form['switch'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable AdElement'),
      '#description' => $this->t('This will enable/disable the AdElement retargeting'),
      '#default_value' => $config->get('switch')
    ];

    $form['depth'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Account Creation Confirmation Depth'),
      '#description' => $this->t('Depth value for account creation confirmation page'),
      '#size' => 255,
      '#default_value' => $config->get('depth'),
    ];

    $form['page'] = [
      '#type' => 'textfield',
      '#title' => t('Account Creation Confirmation Page Path'),
      '#description' => $this->t('Page path of account creation confirmation page'),
      '#size' => 255,
      '#default_value' => $config->get('page'),
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'switch',
      'depth',
      'page'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_marketing_script.providers_adelement_settings')->set($key, $form_state->getValue($key))->save();
    }
  }

}
