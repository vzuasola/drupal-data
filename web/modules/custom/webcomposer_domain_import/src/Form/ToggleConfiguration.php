<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Toggle.
 */
class ToggleConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.toggle_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'toggle_configuration';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.toggle_configuration');

    $form['domain_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Legacy Domain Token system'),
      '#default_value' => $config->get('domain_toggle'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'domain_toggle',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.toggle_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
