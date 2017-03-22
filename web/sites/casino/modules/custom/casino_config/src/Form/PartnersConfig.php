<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class PartnersConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.partners'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'partners_config_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.partners');

    $form['partners_logo'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Partners logo'),
      '#default_value' => $config->get('partners_logo'),
      '#upload_location' => 'public://upload/tiles',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    );


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = array(
      'partners_logo',
    );
    foreach( $keys as $key ){
      $fid = $form_state->getValue($key);
      $file = File::load($fid[0]);
      $file->setPermanent();
      $file->save();

      $this->config('casino_config.partners')->set("partners_image_url", file_create_url($file->getFileUri()))->save();
      $this->config('casino_config.partners')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }



}
