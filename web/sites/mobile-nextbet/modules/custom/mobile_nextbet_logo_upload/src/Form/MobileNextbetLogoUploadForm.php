<?php

namespace Drupal\mobile_nextbet_logo_upload\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;


/**
 * Mobile Nextbet Logo configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_nextbet_logo_upload",
 *   route = {
 *     "title" = "Mobile Nextbet Logo Configuration",
 *     "path" = "/admin/config/mobile_nextbet_logo_upload/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Nextbet Logo Upload Configuration",
 *     "description" = "Provides configuration for Mobile Logo Upload across all products.",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileNextbetLogoUploadForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['mobile_nextbet_logo_upload.mobile_logo_upload'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form['file_image_mobile_nextbet_logo'] = [
      '#name' => 'file_image_mobile_nextbet_logo',
      '#type' => 'managed_file',
      '#title' => $this->t('Mobile Nextbet Website Logo'),
      '#default_value' => $this->get('file_image_mobile_nextbet_logo'),
      '#upload_location' => 'public://',
      '#required' => true,
      '#translatable' => true,
      '#upload_validators' => [
        'allowed_image_width_height' => ['142x43', '135x41', '128x39'],
        'file_validate_extensions' => ['gif png jpg jpeg svg'],
        'file_validate_unique' => [],
      ],
    ];

    $form['mobile_nextbet_logo_upload_alt'] = [
      '#name' => 'mobile_nextbet_logo_upload_alt',
      '#type' => 'text_format',
      '#title' => $this->t('Mobile Nextbet Logo Alt'),
      '#description' => $this->t('Alt text for image'),
      '#default_value' => $this->get('mobile_nextbet_logo_upload_alt')['value'],
      '#required' => true,
      '#translatable' => true,
    ];

    return $form;
  }
}
