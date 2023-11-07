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
    return ['webcomposer_config.webcomposer_content_slider_settings'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'webcomposer_content_slider_settings';
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
    $form['ContentSliderEntity_settings']['#markup'] ='Webcomposer Content Slider entity entities. Manage field settings here.';

    return parent::buildForm($form, $form_state);
  }

}
