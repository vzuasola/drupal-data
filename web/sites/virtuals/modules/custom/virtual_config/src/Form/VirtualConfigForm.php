<?php

namespace Drupal\virtual_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for virtual Configuration.
 */
class VirtualConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['virtual_config.virtual_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'virtual_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('virtual_config.virtual_configuration');

    $form['virtual'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['virtual_configuration_mobile'] = [
      '#type' => 'details',
      '#title' => ' Mobile Site Url',
      '#group' => 'virtual',
    ];

    $form['virtual_configuration_mobile']['base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Site Url'),
      '#default_value' => $config->get('base_url') ?? 'N/A',
      '#required' => true,
    ];


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'base_url',
    ];

    foreach ($keys as $key) {
        $this->config('virtual_config.virtual_configuration')
            ->set($key, $form_state->getValue($key))
            ->save();
    }
    parent::submitForm($form, $form_state);

  }

}
