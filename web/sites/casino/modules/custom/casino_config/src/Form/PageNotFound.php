<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

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

    $form['page_not_found_image'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $config->get('page_not_found_image'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
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
      'page_not_found_content',
      'page_not_found_image',
    );
    foreach($keys as $key){
      if($key == page_not_found_image){
        $fid = $form_state->getValue($key);
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();
          $this->config('casino_config.page_not_found')->set("page_not_found_image_url", file_create_url($file->getFileUri()))->save();
        }
      }
      $this->config('casino_config.page_not_found')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
