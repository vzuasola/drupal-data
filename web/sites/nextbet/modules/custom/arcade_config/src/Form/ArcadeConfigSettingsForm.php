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

    return $form;
  }
}
