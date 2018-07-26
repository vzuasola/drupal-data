<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Unsupported country configuration 
 */
class UnsupportedCountryConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'unsupported_country_configuration_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.unsupported_country'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.unsupported_country');

    $form['unsupported_country_title'] = [
      '#type' => 'textfield',
      '#title' => t('Not supported country title'),
      '#description' => $this->t('Not allowed message title for country.'),
      '#default_value' => $config->get('unsupported_country_title')
    ];

    $config_message = $config->get('unsupported_country_message');
    $form['unsupported_country_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Not allowed message for country.'),
      '#default_value' => $config_message['value'],
      '#format' => $config_message['format'],
    ];

    $form['unsupported_country_button'] = [
      '#type' => 'textfield',
      '#title' => t('Unsupported Country button'),
      '#description' => $this->t('Defines the Unsupported country LightBox Ok button'),
      '#default_value' => $config->get('unsupported_country_button')
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'unsupported_country_title',
      'unsupported_country_message',
      'unsupported_country_button',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.unsupported_country')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
