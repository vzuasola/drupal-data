<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class OutdatedBrowserConfiguration extends ConfigFormBase {
  
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.browser_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'browser_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.browser_configuration');

    $d = $config->get('message');

    $form['message'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Outdated browser message'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $this->config('webcomposer_config.browser_configuration')->set('message',$form_state->getValue('message'))->save();

    return parent::submitForm($form, $form_state);
  }

}
