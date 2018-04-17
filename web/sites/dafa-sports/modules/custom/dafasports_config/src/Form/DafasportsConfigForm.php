<?php

namespace Drupal\dafasports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
/**
 * Sample form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "dafasports_config",
 *   route = {
 *     "title" = "Dafasports Configuration",
 *     "path" = "/admin/config/webcomposer/config/custom",
 *   },
 *   menu = {
 *     "title" = "Dafasports Custom Configuration",
 *     "description" = "Dafasports Custom configuration",
 *     "parent" = "dafasports_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class DafasportsConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['dafasports_config.dafasports_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Background Configuration'),
    ];

    $this->sectionBg($form);

    return $form;
  }

  /**
   *
   */
  private function sectionBg(array &$form) {
    $form['background_config'] = [
      '#type' => 'details',
      '#title' => $this->t('Background Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['background_config']['file_image_bg'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background Image'),
      '#description' => $this->t('Adds Background Image'),
      '#default_value' => $this->get('file_image_bg'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];
  }
}
