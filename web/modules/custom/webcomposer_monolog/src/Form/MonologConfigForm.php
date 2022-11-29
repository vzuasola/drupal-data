<?php

namespace Drupal\webcomposer_monolog\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;

/**
 * Webcomposer Monolog plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "monolog_configuration_form",
 *   route = {
 *     "title" = "Monolog Configuration",
 *     "path" = "/admin/config/webcomposer/config/monolog-configuration",
 *   },
 *   menu = {
 *     "title" = "Monolog Configuration",
 *     "description" = "Provides configuration for webcomposer_monolog module",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class MonologConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.monolog_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['min_log_level'] = array(
      '#type' => 'select',
      '#title' => $this->t('Minimum Log Level'),
      '#default_value' => $this->get('min_log_level'),
      '#options' => array(
        100 => $this->t('Debug'),
        200 => $this->t('Info'),
        250 => $this->t('Notice'),
        300 => $this->t('Warning'),
        400 => $this->t('Error'),
        500 => $this->t('Critical'),
        550 => $this->t('Alert'),
        600 => $this->t('Emergency'),
      ),
      '#description' => $this->t('The minimum level of logs that we want Monolog to store in the log file.'),
    );

    return $form;
  }
}
