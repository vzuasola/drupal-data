<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class PageNotFound extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.page_not_found'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dafabet_keyword_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.page_not_found');
      $form['page_not_found_title'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $config->get('page_not_found_title'),
      );
      $d = $config->get('page_not_found_content');
      $form['page_not_found_content'] = array(
          '#type' => 'text_format',
          '#title' => $this->t('Content'),
          '#default_value' => $d['value'],
          '#format' => $d['format']
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
      'page_not_found_title',
      'page_not_found_content'
    );
    foreach($keys as $key){
      $this->config('casino_config.page_not_found')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
