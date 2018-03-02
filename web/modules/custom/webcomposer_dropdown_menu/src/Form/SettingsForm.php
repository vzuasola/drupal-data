<?php

namespace Drupal\webcomposer_dropdown_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Dropdown form
 *
 * @package Drupal\webcomposer_dropdown_menu\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_config.dropdown_menu_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_dropdown_menu.settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.dropdown_menu_settings');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Configuration Settings'),
    ];

    $form['error'] = [
      '#type' => 'details',
      '#title' => $this->t('Error Messages'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['error']['error_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Generic Error Message'),
      '#description' => $this->t('Add text that will display as a message when player encounters an error.'),
      '#default_value' => $config->get('error_title'),
      '#required' => TRUE,
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
    parent::submitForm($form, $form_state);

    $keys = [
      'error_title',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.dropdown_menu_settings')->set($key, $form_state->getValue($key))->save();
    }
  }
}
