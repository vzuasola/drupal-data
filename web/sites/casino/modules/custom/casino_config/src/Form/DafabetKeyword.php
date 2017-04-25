<?php


namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class DafabetKeyword extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.dafabet_keyword'];
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
    $config = $this->config('casino_config.dafabet_keyword');
      $form['dafabet_keyword_title'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $config->get('dafabet_keyword_title'),
      );
      $d = $config->get('dafabet_keyword_content');
      $form['dafabet_keyword_content'] = array(
          '#type' => 'text_format',
          '#title' => $this->t('content'),
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
      'dafabet_keyword_title',
      'dafabet_keyword_content'
    );
    foreach($keys as $key){
      $this->config('casino_config.dafabet_keyword')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
