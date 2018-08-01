<?php

namespace Drupal\webcomposer_slider_v2\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebcomposerSliderV2EntitySettingsForm.
 *
 * @package Drupal\webcomposer_slider_v2\Form
 *
 * @ingroup webcomposer_slider_v2
 */
class WebcomposerSliderV2EntitySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.slider_v2_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'webcomposer_slider_v2';
  }

  /**
   * Defines the settings form for Webcomposer slider 2.0 entity entities.
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
    $config = $this->config('webcomposer_config.slider_v2_configuration');

    $form['WebcomposerSliderV2Entity_settings']['#markup'] ='Webcomposer slider 2.0 entity entities. Manage field settings here.';

    $form['WebcomposerSliderV2Entity_settings']['enable_collapsible_slider'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Collapsible Slider 2.0.'),
      '#default_value' => $config->get('enable_collapsible_slider'),
    ];

    $form['WebcomposerSliderV2Entity_settings']['slider_pager_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Slider 2.0 Pager Position'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('slider_pager_position') ? $config->get('slider_pager_position') : 'center',
    ];

    $form['WebcomposerSliderV2Entity_settings']['enable_transition_slider'] = [
      '#type' => 'select',
      '#title' => $this->t('Slider 2.0 Blurb Animation'),
      '#options' => [
        't-none' => 'none',
        't-1s' => '1s',
        't-2s' => '2s',
        't-3s' => '3s',
      ],
      '#default_value' => $config->get('enable_transition_slider') ? $config->get('enable_transition_slider') : 'none',
    ];

    return parent::buildForm($form, $form_state);
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
      'enable_transition_slider',
      'slider_pager_position',
      'enable_collapsible_slider',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.slider_v2_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
