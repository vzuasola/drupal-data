<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class LobbyRightTile extends ConfigFormBase{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.lobby_right_tile'];
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
    $config = $this->config('casino_config.lobby_right_tile');

    $form['lobby_right_tile_title'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $config->get('lobby_right_tile_title'),
        '#required' => TRUE,
    );

    $form['lobby_right_tile_image'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $config->get('lobby_right_tile_image'),
      '#upload_location' => 'public://upload/tiles',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
      '#required' => TRUE,
    );

    $d = $config->get('lobby_right_tile_content');
    $form['lobby_right_tile_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#required' => TRUE,
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
      'lobby_right_tile_title',
      'lobby_right_tile_content',
      'lobby_right_tile_image',
    );
    
    foreach($keys as $key){
      if($key == "lobby_right_tile_image"){
        $fid = $form_state->getValue($key);
        $file = File::load($fid[0]);
        $file->setPermanent();
        $file->save();
        $file_usage = \Drupal::service('file.usage');
        $file_usage->add($file, 'casino_config', 'managed_file', $fid[0]);
        $this->config('casino_config.lobby_right_tile')->set("lobby_right_tile_image_url", file_create_url($file->getFileUri()))->save();
      }

      $this->config('casino_config.lobby_right_tile')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
