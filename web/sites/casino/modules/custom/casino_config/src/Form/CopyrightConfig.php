<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CopyrightConfig extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.copyright_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'copyright_config_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.copyright_config');
      $form['copyright_label'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Copyright Label'),
          '#default_value' => $config->get('copyright_label'),
      );
      $form['all_right_reserved_label'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('All right Reserved Label'),
          '#default_value' => $config->get('all_right_reserved_label'),
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
    $keys = array(
      'copyright_label',
      'all_right_reserved_label'
    );
    foreach($keys as $key){
      $this->config('casino_config.copyright_config')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}

