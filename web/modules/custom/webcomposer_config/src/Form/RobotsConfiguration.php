<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Header Configuration.
 */
class RobotsConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.robots_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'robots_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.robots_configuration');
    $form['robots_configuration'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Robots.txt configuration'),
      '#rows' => 15,
      '#description' => $this->t('This is config only applicable main domain eg: www.dafabet.com/robots.txt'),
      '#default_value' => $config->get('robots_configuration'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'robots_configuration',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.robots_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
