<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Logging.
 */
class LogConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.log_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'log_configuration';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.log_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['logging_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Metrics Logging'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['logging_settings']['disable_logging'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable Metrics logging'),
      '#default_value' => $config->get('disable_logging'),
    ];

    $form['logging_settings']['logging_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL where to log'),
      '#default_value' => $config->get('logging_url'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'disable_logging',
      'logging_url',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.log_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
