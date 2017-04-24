<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides configuration settings form for Header Element Configuration.
 */
class FooterConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.footer_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'footer_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.footer_config');

    $form['footer_settings_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['quicklinks_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Quicklinks Title'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );

    $form['quicklinks_group']['quicklinks_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Quicklink Title'),
      '#description' => $this->t('Text to be displayed in quicklink title.'),
      '#default_value' => $config->get('quicklinks_title'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = array(
      'quicklinks_title',
    );
    foreach ($keys as $key) {
      $this->config('casino_config.footer_config')->set($key, $form_state->getValue($key))->save();
    }
    return parent::submitForm($form, $form_state);
  }

}
