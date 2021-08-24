<?php

namespace Drupal\desktop_slider\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ClassDesktopSliderSettingsForm.
 *
 * @ingroupdesktop_slider
 */
class DesktopSliderSettingsForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['webcomposer_config.desktop_slider_configuration'];
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId()
  {
    return 'desktop_slider_settings';
  }

  /**
   * Defines the settings form for Desktop Slider entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('webcomposer_config.desktop_slider_configuration');

    $form['desktop_slider_settings']['#markup'] = 'Settings form for Desktop Slider entities. Manage field settings here.';

    $form['desktop_slider_settings']['enable_collapsible_slider'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Collapsible Desktop Slider.'),
      '#default_value' => $config->get('enable_collapsible_slider'),
    ];

    $form['desktop_slider_settings']['slider_pager_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Desktop Slider Pager Position'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('slider_pager_position') ? $config->get('slider_pager_position') : 'center',
    ];

    $form['desktop_slider_settings']['enable_transition_slider'] = [
      '#type' => 'select',
      '#title' => $this->t('Desktop Slider Blurb Animation'),
      '#options' => [
        't-none' => 'none',
        't-1s' => '.5s',
        't-2s' => '1s',
        't-3s' => '2s',
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
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $keys = [
      'enable_transition_slider',
      'slider_pager_position',
      'enable_collapsible_slider',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.desktop_slider_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}
