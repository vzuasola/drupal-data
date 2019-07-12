<?php

namespace Drupal\webcomposer_single_signon\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AuthenticationForm.
 *
 * @package Drupal\webcomposer_single_signon\Form
 */
class AuthenticationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_config.single_signon',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'authentication_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.single_signon');

    $form['single_signon_server'] = [
      '#type' => 'textfield',
      '#title' => t('Single Signon Server'),
      '#description' => $this->t('Defines the endpoint used for authenticating single signon'),
      '#default_value' => $config->get('single_signon_server')
    ];

    $form['supported_domains'] = [
      '#type' => 'textarea',
      '#title' => t('Supported Domains'),
      '#description' => $this->t('Define the domains that the Single Sign On will allow requests from.<br>One domain per line. Supports wildcard.'),
      '#default_value' => $config->get('supported_domains')
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'single_signon_server',
      'supported_domains',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.single_signon')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
