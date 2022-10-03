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

    $form['optimize_import'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Optimize Domain Import'),
      '#default_value' => $config->get('optimize_import'),
    ];

    $form['use_batch_export'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Batch Export'),
      '#default_value' => $config->get('use_batch_export'),
    ];

    $form['use_v2_domain'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use domain version 2'),
      '#default_value' => $config->get('use_v2_domain'),
    ];

    $domain_batch = $config->get('domains_batch');
    $default_batch = isset($domain_batch)?$domain_batch:4;
    $form['domains_batch'] = [
      '#type' => 'select',
      '#inline' => TRUE,
      '#options' => range(1, 100),
      '#title' => $this->t('Domains Per Batch'),
      '#default_value' => $default_batch,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'domain_toggle',
      'optimize_import',
      'domains_batch',
      'use_v2_domain',
      'use_batch_export',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.toggle_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
