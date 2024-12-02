<?php
namespace Drupal\arcade_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * How to Play form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "arcade_config_settings",
 *   route = {
 *     "title" = "Manage Game General Settings",
 *     "path" = "/admin/config/arcade/games/settings",
 *   },
 *   menu = {
 *     "title" = "Manage Game General Settings",
 *     "description" = "Manage Game General Settings",
 *     "parent" = "arcade_config.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class ArcadeConfigSettingsForm extends FormBase {
  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['arcade_config.settings'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['category_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $form['general'] = array(
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
      '#group' => 'category_tab'
    );

    $form['general']['is_ordinary_secondary_categories_rendering_enabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Is Ordinary/Secondary Categories Rendering Enabled?'),
      '#description' => $this->t('Enable category rendering in two rows at the top of the ARC lobby page to allow easy filtering of games by category'),
      '#default_value' => $this->get('is_ordinary_secondary_categories_rendering_enabled'),
      '#translatable' => FALSE,
    );

    $form['general']['more_providers_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More Providers Label'),
      '#default_value' => $this->get('more_providers_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['file_image_more_providers'] = [
      '#name' => 'file_image_more_providers',
      '#type' => 'managed_file',
      '#title' => $this->t('More Providers Icon (PNG)'),
      '#default_value' => $this->get('file_image_more_providers'),
      '#upload_location' => 'public://',
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
        'file_validate_unique' => [],
      ],
    ];

    $form['general']['more_categories_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More Categories Label'),
      '#default_value' => $this->get('more_categories_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['file_image_more_categories'] = [
      '#name' => 'file_image_more_categories',
      '#type' => 'managed_file',
      '#title' => $this->t('More Categories Icon (PNG)'),
      '#default_value' => $this->get('file_image_more_categories'),
      '#upload_location' => 'public://',
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
        'file_validate_unique' => [],
      ],
    ];

    $form['general']['back_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back Label'),
      '#default_value' => $this->get('back_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['file_image_back'] = [
      '#name' => 'file_image_back',
      '#type' => 'managed_file',
      '#title' => $this->t('Back Icon (PNG)'),
      '#default_value' => $this->get('file_image_back'),
      '#upload_location' => 'public://',
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
        'file_validate_unique' => [],
      ],
    ];

    $form['general']['sort_by_title_ascending_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sort by Title (Ascending) Label'),
      '#default_value' => $this->get('sort_by_title_ascending_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['file_image_sort_by_title_ascending'] = [
      '#name' => 'file_image_sort_by_title_ascending',
      '#type' => 'managed_file',
      '#title' => $this->t('Sort by Title (Ascending) Icon (PNG)'),
      '#default_value' => $this->get('file_image_sort_by_title_ascending'),
      '#upload_location' => 'public://',
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
        'file_validate_unique' => [],
      ],
    ];

    $form['general']['sort_by_title_descending_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sort by Title (Descending) Label'),
      '#default_value' => $this->get('sort_by_title_ascending_label'),
      '#translatable' => TRUE,
    ];

    $form['general']['file_image_sort_by_title_descending'] = [
      '#name' => 'file_image_sort_by_title_descending',
      '#type' => 'managed_file',
      '#title' => $this->t('Sort by Title (Descending) (PNG)'),
      '#default_value' => $this->get('file_image_sort_by_title_descending'),
      '#upload_location' => 'public://',
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
        'file_validate_unique' => [],
      ],
    ];

    return $form;
  }
}
