<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class List.
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class OverviewForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_form_manager.list',
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigName() {
    return 'webcomposer_form_manager.list';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'list';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $name = $this->getDefaultConfigName();

    $form['javascript_assets'] = array(
      '#type' => 'textarea',
      '#title' => t('Javascript Assets'),
      '#size' => 500,
      '#description' => $this->t('Define the Playtech scripts that should be included on game launch. Provide one script per line'),
      '#default_value' => $this->getConfigValues($name, 'javascript_assets')
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
    parent::submitForm($form, $form_state);

    $name = $this->getDefaultConfigName();

    $keys = [
      'javascript_assets',
    ];

    $this->saveConfigValues($name, $keys, $form_state);
  }
}
