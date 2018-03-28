<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Curacao configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_curacao",
 *   route = {
 *     "title" = "Curacao Configuration",
 *     "path" = "/admin/config/webcomposer/config/curacao",
 *   },
 *   menu = {
 *     "title" = "Curacao Configuration",
 *     "description" = "Provides configuration for Curacao",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class CuracaoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.curacao'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Curacao Configuration'),
    ];

    $form['curacao'] = [
      '#type' => 'details',
      '#title' => $this->t('Curacao Settings'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['curacao']['script_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Script URI'),
      '#description' => $this->t('Provides the script URI of curacao resource script.'),
      '#default_value' => $this->get('script_path'),
    ];

    $form['curacao']['markup'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Markup'),
      '#description' => $this->t('The markup that will be used as substitute to Curacao'),
      '#default_value' => $this->get('markup'),
    ];

    return $form;
  }
}
