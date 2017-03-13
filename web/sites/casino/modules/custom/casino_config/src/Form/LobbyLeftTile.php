<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LobbyLeftTile extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.lobby_left_tile'];
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
    $config = $this->config('casino_config.lobby_left_tile');
      $form['lobby_left_title'] = array(
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#default_value' => $config->get('lobby_left_title'),
      );
      $d = $config->get('lobby_left_content');
      $form['lobby_left_content'] = array(
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
      'lobby_left_title',
      'lobby_left_content'
    );
    foreach($keys as $key){
      $this->config('casino_config.lobby_left_tile')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
