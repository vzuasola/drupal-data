<?php

namespace Drupal\poker_grid_menu\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Grid Menu form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "grid_menu_settings_form",
 *   route = {
 *     "title" = "Grid Menu Settings",
 *     "path" = "/admin/config/poker_grid_menu/settings",
 *   },
 *   menu = {
 *     "title" = "Grid Menu Settings",
 *     "description" = "Provides configuration for Grid Menu",
 *     "parent" = "poker_grid_menu.list",
 *     "weight" = -5
 *   },
 * )
 */
class GridMenuSettingsForm extends FormBase {
  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['poker_config.grid_menu'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $config = $this->config('poker_config.grid_menu');

    $form['file_image_background_image'] = [
      '#type' => 'managed_file',
      '#title' => t('Background Image (Parallax)'),
      '#description' => t('The recommended upload size is between 1920x300 to 1920x500.<br>
        Allowed types: png gif jpg jpeg'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
        'file_validate_image_resolution' => ['1920x500', '1920x300']
      ],
      '#default_value' => $config->get('file_image_background_image'),
      '#required' => TRUE,
    ];

    return $form;
  }
}
