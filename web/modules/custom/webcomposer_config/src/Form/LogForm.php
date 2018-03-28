<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Log configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_log",
 *   route = {
 *     "title" = "Log Configuration",
 *     "path" = "/admin/config/webcomposer/config/log",
 *   },
 *   menu = {
 *     "title" = "Log Configuration",
 *     "description" = "Provides configuration for logging mechanisms",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class LogForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.log_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Log Configuration'),
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
      '#default_value' => $this->get('disable_logging'),
    ];

    $form['logging_settings']['logging_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL where to log'),
      '#default_value' => $this->get('logging_url'),
    ];

    return $form;
  }
}
