<?php

namespace Drupal\webcomposer_avaya\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Avaya chat configuration class.
 */
class AvayaChatConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'avaya_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.avaya_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get Form configuration.
    $config = $this->config('webcomposer_config.avaya_configuration');
    $form['avaya'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Global Configuration',
      '#group' => 'avaya',
    ];

    $form['field_configuration']['base_url'] = [
      '#type' => 'textarea',
      '#title' => t('Avaya Chat Base URL'),
      '#description' => $this->t('Link for Live Chat.'),
      '#default_value' => $config->get('base_url'),
      '#rows' => 3
    ];

    $form['field_configuration']['url_post'] = [
      '#type' => 'textarea',
      '#title' => $this->t('URL Post'),
      '#description' => $this->t('Avaya API url'),
      '#default_value' => $config->get('url_post'),
      '#rows' => 1
    ];

    $form['field_configuration']['url_post_timout'] = [
      '#type' => 'number',
      '#title' => $this->t('URL Post Timeout'),
      '#description' => $this->t('Ajax Timeout'),
      '#maxlength' => 255,
      '#default_value' => $config->get('url_post_timout'),
    ];

    $form['field_configuration']['jwt_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JWT Key'),
      '#description' => $this->t('Key for JWT'),
      '#size' => 255,
      '#default_value' => $config->get('jwt_key'),
    ];

    $form['field_configuration']['validity_time'] = [
      '#type' => 'number',
      '#title' => $this->t('Validation Time (Seconds)'),
      '#description' => $this->t('Time of validity of JWT Token in seconds.'),
      '#maxlength' => 255,
      '#default_value' => $config->get('validity_time'),
    ];

    $form['field_configuration']['xdomain_proxy'] = [
      '#type' => 'textarea',
      '#title' => $this->t('XDomain Proxy'),
      '#description' => $this->t(
        'The protocol and domain of the XDomain proxy for CORS support (eg. https://www.cs-livechat.com)'
      ),
      '#default_value' => $config->get('xdomain_proxy'),
      '#rows' => 1
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
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
    $keys = [
      'base_url',
      'url_post',
      'url_post_timout',
      'jwt_key',
      'validity_time',
      'xdomain_proxy',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.avaya_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
