<?php

namespace Drupal\webcomposer_content_slider\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ContentSliderEntitySettingsForm.
 *
 * @package Drupal\webcomposer_content_slider\Form
 *
 * @ingroup webcomposer_content_slider
 */
class ContentSliderEntitySettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.content_slider_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'webcomposer_content_slider';
  }

  /**
   * Defines the settings form for Slider entity entities.
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
    $config = $this->config('webcomposer_config.content_slider_configuration');

    $form['ContentSliderEntity_settings']['#markup'] ='Webcomposer Content Slider entity entities. Manage field settings here.';

    $form['ContentSliderEntity_settings']['content_slider_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Content Slider Title'),
      '#default_value' => $config->get('content_slider_title'),
      '#translatable'=> true
    ];

    $form['ContentSliderEntity_settings']['content_slider_close_btn_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Content Slider Close Button Label'),
      '#default_value' => $config->get('content_slider_close_btn_label'),
      '#translatable'=> true
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
      'content_slider_title',
      'content_slider_close_btn_label'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.content_slider_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
