<?php

namespace Drupal\keno_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Trust Element.
 */
class TrustElementForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['keno_config.trust_element_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'trust_element_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('keno_config.trust_element_config');

    $form['trust_element_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('trust_element_title'),
    ];

    $d = $config->get('trust_element_content');
    $form['trust_element_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $kenoConfig = [
      'trust_element_title',
      'trust_element_content',
    ];
    foreach ($kenoConfig as $keys) {
        $this->config('keno_config.trust_element_config')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
