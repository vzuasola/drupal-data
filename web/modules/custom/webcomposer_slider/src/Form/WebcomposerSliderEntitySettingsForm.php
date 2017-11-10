<?php

namespace Drupal\webcomposer_slider\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebcomposerSliderEntitySettingsForm.
 *
 * @package Drupal\webcomposer_slider\Form
 *
 * @ingroup webcomposer_slider
 */
class WebcomposerSliderEntitySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.slider_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'webcomposer_slider';
  }

  /**
   * Defines the settings form for Webcomposer slider entity entities.
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
    $config = $this->config('webcomposer_config.slider_configuration');

    $form['WebcomposerSliderEntity_settings']['#markup'] = 'Settings form for Webcomposer slider entity entities. Manage field settings here.';

    $form['WebcomposerSliderEntity_settings']['enable_collapsible_slider'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Collapsible Slider.'),
      '#default_value' => $config->get('enable_collapsible_slider'),
    ];

    $form['WebcomposerSliderEntity_settings']['slider_pager_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Slider Pager Position'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('slider_pager_position') ? $config->get('slider_pager_position') : 'center',
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
      'slider_pager_position',
      'enable_collapsible_slider',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.slider_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
