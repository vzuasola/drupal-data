<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Preconnect configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_browser",
 *   route = {
 *     "title" = "Preconnect Configuration",
 *     "path" = "/admin/config/webcomposer/config/preconnect",
 *   },
 *   menu = {
 *     "title" = "Preconnect Configuration",
 *     "description" = "Provides configuration for browser behaviors",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class PreconnectForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.preconnect_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Preconnect Configuration'),
    ];

    $form['hosts'] = [
      '#type' => 'details',
      '#title' => $this->t('Precoonect hosts'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['hosts']['list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Hosts to preconnect'),
      '#description' => $this->t('A list of base URLs to which we should preconnect. (one URL per line)'),
      '#default_value' => $this->get('list'),
      '#translatable' => false,
    ];

    return $form;
  }
}
