<?php

namespace Drupal\webcomposer_marketing_script\Form\Providers;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

abstract class MarketingScriptProviderBase extends ConfigFormBase {
  /**
   * Defines the marketing script provider ID
   *
   * @return string
   */
  abstract protected function getMarketingScriptConfigName();

  /**
   * Defines the editable config names
   *
   * @return array List of editable config names
   */
  abstract protected function submitValues();

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_marketing_script.providers'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    $id = $this->getMarketingScriptConfigName();

    return "MarketingScript_providers_$id_settings";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $id = $this->getMarketingScriptConfigName();

    $form['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable'),
      '#description' => $this->t('Enable or disable this provider'),
      '#default_value' => $this->getConfig('enable'),
    ];

    return $form;
  }

  /**
   *
   */
  protected function getConfig($name, $default = NULL) {
    $id = $this->getMarketingScriptConfigName();
    $configs = $this->config('webcomposer_marketing_script.providers')->get($id);

    return isset($configs[$name]) ? $configs[$name] : $default;
  }

  /**
   *
   */
  protected function getConfigs() {
    $id = $this->getMarketingScriptConfigName();

    return $this->config('webcomposer_marketing_script.providers')->get($id);
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
    $id = $this->getMarketingScriptConfigName();

    $data = [];

    $values = $this->submitValues();
    $values[] = 'enable';

    foreach ($values as $value) {
      $data[$value] = $form_state->getValue($value);
    }

    $this->config('webcomposer_marketing_script.providers')->set($id, $data)->save();
  }
}
