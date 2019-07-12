<?php

namespace Drupal\webcomposer_cache\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_cache.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_cache.settings');

    $enable = $config->get('enable');

    if ($enable) {
      $desc = $this->t('Regenerate the cache signature without clearing the cache');

      $form['description'] = [
        '#markup' => "<p>$desc</p>",
      ];

      $form['generate'] = [
        '#type' => 'submit',
        '#value' => t('Generate new signature'),
        '#submit' => ['::submitRegenerate']
      ];

      $signature = \Drupal::service('webcomposer_cache.signature_manager')->getSignature();

      if ($signature) {
        $case = strtoupper($signature);
        $message = "Current Redis signature is <strong>$case</strong>";
      } else {
        $message = "<strong>Cannot connect to Redis</strong>";
      }

      $form['signature'] = [
        '#markup' => "<p>$message</p>",
      ];
    }

    $form['wrap'] = [
      '#type' => 'details',
      '#title' => $this->t('Cache Settings'),
      '#description' => $this->t('Control cache settings and behaviors.'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['wrap']['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Cache Signature'),
      '#description' => $this->t('If checked will allow Drupal to generate cache signature to Redis.'),
      '#default_value' => $enable,
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
   * Submit handler for regenerate Redis signature
   */
  public function submitRegenerate() {
    \Drupal::service('webcomposer_cache.signature_manager')->renewSignature();

    drupal_set_message($this->t('A new Redis Signature has been generated.'));
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // check to see if we are turning off the cache

    $config = $this->config('webcomposer_cache.settings');

    $enable = $config->get('enable');
    $next = $form_state->getValue('enable');

    if ($enable && !$next) {
      try {
        \Drupal::service('webcomposer_cache.signature_manager')->deleteSignature();
      } catch (\Exception $e) {
        // do nothing
      }
    }

    $keys = [
      'enable',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_cache.settings')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
