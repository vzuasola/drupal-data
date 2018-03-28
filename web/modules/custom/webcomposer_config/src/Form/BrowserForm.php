<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Browser configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_browser",
 *   route = {
 *     "title" = "Browser Configuration",
 *     "path" = "/admin/config/webcomposer/config/browser",
 *   },
 *   menu = {
 *     "title" = "Browser Configuration",
 *     "description" = "Provides configuration for browser behaviors",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class BrowserForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.browser_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Browser Configuration'),
    ];

    $form['outdated'] = [
      '#type' => 'details',
      '#title' => $this->t('Outdated Browser Settings'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $default = $this->get('message');

    $form['outdated']['message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Outdated browser message'),
      '#description' => $this->t('Add outdated browser message.'),
      '#default_value' => $default['value'],
      '#format' => $default['format'],
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
