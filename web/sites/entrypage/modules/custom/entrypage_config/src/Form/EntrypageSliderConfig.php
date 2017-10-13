<?php

namespace Drupal\entrypage_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class EntrypageSliderConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['entrypage_config.entrypage_slider_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entrypage_config.entrypage_slider_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('entrypage_config.entrypage_slider_configuration');

    $form['slider_settings_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['pagination_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Banner Pagination Position'),
      '#collapsible' => TRUE,
      '#group' => 'slider_settings_tab',
    );

    $form['pagination_group']['pagination_position'] = array(
      '#type' => 'select',
      '#title' => $this->t('Banner Pagination Position'),
      '#description' => $this->t('Set Pagination Position of Banner Slider.'),
      '#default_value' => $config->get('pagination_position'),
      '#options' => array(
                      'left'  => $this->t('Left'),
                      'center'=> $this->t('Center'),
                      'right' => $this->t('Right'),
                    ),
    );



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
      'pagination_position'
    ];

    foreach($keys as $key) {
      // Saving the Values.
      $this->config('entrypage_config.entrypage_slider_configuration')
          ->set($key, $form_state->getValue($key))
          ->save();
    }

    parent::submitForm($form, $form_state);
  }

}
