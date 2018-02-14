<?php

namespace Drupal\keno_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Configuration Form for Keno Configuration.
 */
class KenoConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['keno_config.keno_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'keno_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('keno_config.keno_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Keno Configurations'),
    ];

    $form['keno_gen_config'] = [
      '#type' => 'details',
      '#title' => t('Keno General Configurations'),
      '#group' => 'advanced',
    ];

    $form['keno_gen_config']['keno_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background'),
      '#default_value' => $config->get('keno_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['trust_element'] = [
      '#type' => 'details',
      '#title' => t('Trust Element'),
      '#group' => 'advanced',
    ];

    $form['trust_element']['trust_element_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('trust_element_title'),
    ];

    $data = $config->get('trust_element_content');
    $form['trust_element']['trust_element_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $data['value'],
      '#format' => $data['format'],
    ];

    $form['lobby_tiles'] = [
      '#type' => 'details',
      '#title' => t('Lobby Tiles'),
      '#group' => 'advanced',
    ];

    $form['lobby_tiles']['lobby_tiles_alignment'] = [
      '#type' => 'select',
      '#title' => $this->t('Lobby Tiles Alignment'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('lobby_tiles_alignment'),
    ];

    $form['basic_page'] = [
      '#type' => 'details',
      '#title' => t('Basic Page'),
      '#group' => 'advanced',
    ];

    $form['basic_page']['basic_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Basic Page Background Image'),
      '#default_value' => $config->get('basic_page_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $kenoConfig = [
      'trust_element_title',
      'trust_element_content',
      'lobby_tiles_alignment',
      'keno_background',
      'basic_page_background',
    ];
    foreach ($kenoConfig as $keys) {
      if ($keys == 'keno_background') {
        $fid = $form_state->getValue('keno_background');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'keno_config', 'image', $fid[0]);

          $this->config('keno_config.keno_configuration')->set("keno_background_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('keno_config.keno_configuration')->set("keno_background_image_url", null);
        }
      }
      if ($keys == 'basic_page_background') {
        $fid = $form_state->getValue('basic_page_background');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'keno_config', 'image', $fid[0]);

          $this->config('keno_config.keno_configuration')->set("basic_page_background_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('keno_config.keno_configuration')->set("basic_page_background_image_url", null);
        }
      }
      $this->config('keno_config.keno_configuration')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
