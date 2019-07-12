<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Configuration Form for the Page Not Found.
 */
class PageNotFound extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.page_not_found'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pageNotFound_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.page_not_found');
    $form['page_not_found_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('page_not_found_title'),
    ];

    $form['page_not_found_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $config->get('page_not_found_image'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $d = $config->get('page_not_found_content');
    $form['page_not_found_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'page_not_found_title',
      'page_not_found_content',
      'page_not_found_image',
    ];
    foreach ($keys as $key) {
      if ($key == 'page_not_found_image') {
        $fid = $form_state->getValue($key);
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();
          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'entrypage', 'image', $fid[0]);

          $this->config('webcomposer_config.page_not_found')->set("page_not_found_image_url", file_create_url($file->getFileUri()))->save();
        }
      }
      $this->config('webcomposer_config.page_not_found')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
