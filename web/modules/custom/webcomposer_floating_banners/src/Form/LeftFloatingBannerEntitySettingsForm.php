<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class LeftFloatingBannerEntitySettingsForm.
 *
 * @package Drupal\webcomposer_floating_banners\Form
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntitySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.floating_banner_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'LeftFloatingBannerEntity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'enable_per_product',
      'banner_v2_enable',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.floating_banner_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

  /**
   * Defines the settings form for Left floating banner entity entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.floating_banner_configuration');

    $form['LeftFloatingBannerEntity_settings']['enable_per_product'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Per Product Configuration'),
      '#default_value' => $config->get('enable_per_product'),
    ];

    $form['LeftFloatingBannerEntity_settings']['banner_v2_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable V2'),
      '#default_value' => $config->get('banner_v2_enable'),
      '#translatable' => TRUE,
    ];

    $form['LeftFloatingBannerEntity_settings']['#markup'] = 'Settings form for Floating Banner entities. Manage field settings here.';

    return parent::buildForm($form, $form_state);
  }
}
