<?php

namespace Drupal\poker_grid_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Avaya chat configuration class
 */
class GridMenuSettingsForm extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'grid_menu_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['poker_config.grid_menu_settings'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('poker_config.grid_menu_settings');

    $form['background_image'] = [
      '#type' => 'managed_file',
      '#title' => t('Background Image (Parallax)'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_image_resolution' => ['1920x360']
      ],
      '#default_value' => $config->get('background_image'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'background_image',
    ];

    foreach ($keys as $key) {
      if ($key == 'background_image') {
        $fid = $form_state->getValue($key);
        $file = File::load($fid[0]);
        $this->config('poker_config.grid_menu_settings')->set($key . '_file', file_create_url($file->getFileUri()))->save();
      }
        
      $this->config('poker_config.grid_menu_settings')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
