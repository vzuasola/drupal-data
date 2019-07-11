<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Curacao.
 */
class CuracaoConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.curacao'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'curacao';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.curacao');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
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
      '#default_value' => $config->get('script_path'),
    ];

    $form['curacao']['markup'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Markup'),
      '#description' => $this->t('The markup that will be used as substitute to Curacao'),
      '#default_value' => $config->get('markup'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'script_path',
      'markup',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.curacao')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
