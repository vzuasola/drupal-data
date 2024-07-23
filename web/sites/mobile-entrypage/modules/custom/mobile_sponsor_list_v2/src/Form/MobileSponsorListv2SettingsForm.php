<?php

namespace Drupal\mobile_sponsor_list_v2\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MobileSponsorListv2SettingsForm.
 *
 *  @package Drupal\mobile_sponsor_list_v2\Form
 *
 * @ingroup mobile_sponsor_list_v2
 */
class MobileSponsorListv2SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['webcomposer_config.mobile_sponsor_list_v2'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'mobile_sponsor_list_v2_settings';
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
      'field_sponsor_title_font_size',
      'field_sponsor_subtitle_font_size',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.mobile_sponsor_list_v2')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

  /**
   * Defines the settings form for Mobile Sponsor List version 2.0. entities.
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
    $config = $this->config('webcomposer_config.mobile_sponsor_list_v2');
    $form['mobile_sponsor_list_v2_settings']['field_sponsor_title_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $config->get('field_sponsor_title_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['mobile_sponsor_list_v2_settings']['field_sponsor_subtitle_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $config->get('field_sponsor_subtitle_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['mobile_sponsor_list_v2_settings']['#markup'] = 'Settings form for Mobile Sponsor List version 2.0. entities. Manage field settings here.';
    return parent::buildForm($form, $form_state);
  }

}
