<?php

namespace Drupal\nextbet_logo_upload\Form;

use Drupal\Core\File\FileInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;


/**
 * Nextbet Logo configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_logo_upload",
 *   route = {
 *     "title" = "Nextbet Logo Configuration",
 *     "path" = "/admin/config/nextbet/config/nextbet_logo_upload",
 *   },
 *   menu = {
 *     "title" = "Logo Upload Configuration",
 *     "description" = "Provides configuration for Logo Upload across all products.",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class NextbetLogoUploadForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['nextbet_logo_upload.logo_upload_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form['file_image_nextbet_logo'] = [
      '#name' => 'file_image_nextbet_logo',
      '#type' => 'managed_file',
      '#title' => $this->t('Nextbet Website Logo'),
      '#default_value' => $this->get('file_image_nextbet_logo'),
      '#upload_location' => 'public://',
      '#required' => true,
      '#translatable' => true,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg svg'],
        'allowed_image_heights' => ['50', '55', '60'],
        'file_validate_unique' => [],
      ],
    ];

    $form['nextbet_logo_upload_alt'] = [
      '#name' => 'nextbet_logo_upload_alt',
      '#type' => 'text_format',
      '#title' => $this->t('Nextbet Logo Alt'),
      '#description' => $this->t('Alt text for image'),
      '#default_value' => $this->get('nextbet_logo_upload_alt')['value'],
      '#required' => true,
      '#translatable' => true,
    ];

    return $form;
  }
}
