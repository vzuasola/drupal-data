<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class PromotionConfiguration extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['entrypage_config.promotion_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entrypage_config_promotion_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.footer_configuration');

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    );

    $form['about_dafabet_details'] = array(
      '#type' => 'details',
      '#title' => t('About Dafabet'),
      '#group' => 'advanced',
    );
    
    $form['about_dafabet_details']['about_dafabet_title'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $config->get('about_dafabet_title'),
        '#required' => TRUE,
    );

    $d = $config->get('about_dafabet_content');

    $form['about_dafabet_details']['about_dafabet_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('content'),
        '#default_value' => $d['value'],
        '#format' => $d['format'],
        '#required' => TRUE,
    );

    $form['partners_details'] = array(
      '#type' => 'details',
      '#title' => t('Partners Logo'),
      '#group' => 'advanced',
    );

    $form['partners_details']['partners_logo'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Partners logo'),
      '#default_value' => $config->get('partners_logo'),
      '#upload_location' => 'public://upload/tiles',
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
      ),
    );

    $form['quicklinks_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Quicklinks Title'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = array(
      'about_dafabet_title',
      'about_dafabet_content',
      'partners_logo',
      'quicklinks_title'
    );

    foreach ($keys as $key) {
      if ($key == 'partners_logo') {
        $fid = $form_state->getValue('partners_logo');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'webcomposer_config', 'image', $fid[0]);

          $this->config('webcomposer_config.footer_configuration')->set("partners_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('webcomposer_config.footer_configuration')->set("partners_image_url", null);
        }
      }
      $this->config('webcomposer_config.footer_configuration')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
