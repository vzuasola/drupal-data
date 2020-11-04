<?php
namespace Drupal\arcade_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Arcade custom config form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "arcade_config_form",
 *   route = {
 *     "title" = "Arcade Custom Configuration",
 *     "path" = "/admin/arcade/config",
 *   },
 *   menu = {
 *     "title" = "Arcade Custom Configuration",
 *     "description" = "Configure custom arcade configuration",
 *     "parent" = "arcade_config.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class ArcadeConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.arcade_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['arcade_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->arcadeHeaderSettingsOverride($form);
    $this->arcadeCategorySetting($form);

    return $form;
  }

  private function arcadeCategorySetting(&$form) {
    $form['category_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Arcade Category Settings'),
      '#collapsible' => TRUE,
      '#group' => 'arcade_configuration_tab',
    );

    $form['category_group']['arcade_category_switch'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Arcade Categories'),
      '#description' => $this->t('If disabled all games will be shown at once and categories will not be displayed.'),
      '#default_value' => $this->get('arcade_category_switch'),
      '#required' => FALSE,
    );

    $form['category_group']['special_categories'] = array(
      '#type' => 'fieldset',
      '#title' => t('Special Categories'),
    );
    $form['category_group']['special_categories']['allgames_category_override'] = array(
      '#type' => 'textfield',
      '#title' => t('All Games Categories Override'),
      '#description' => t('Category ID for the all games override.<br/>This will automatically add an alphabetical list of all the games'),
      '#default_value' => $this->get('allgames_category_override'),
      '#required' => true,
    );
    $form['category_group']['special_categories']['recent_games_category_override'] = array(
      '#type' => 'textfield',
      '#title' => t('Recent Games Categories Override'),
      '#description' => t('Category ID for the recent games override.<br/>This will automatically add the recent games data'),
      '#default_value' => $this->get('recent_games_category_override'),
      '#required' => true,
    );
    $form['category_group']['special_categories']['favorites_category_override'] = array(
      '#type' => 'textfield',
      '#title' => t('Favorites Categories Override'),
      '#description' => t('Category ID for the favorite games override.<br/>This will automatically add the favorites data'),
      '#default_value' => $this->get('favorites_category_override'),
      '#required' => true,
    );
  }

  private function arcadeHeaderSettingsOverride(&$form) {
    $form['header_config_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Header Settings Override'),
      '#description' => $this->t(
        '<br/><i><b>NOTE:</b>All empty fields will use the original field under webcomposer header configurations</i>'
      ),
      '#collapsible' => TRUE,
      '#group' => 'arcade_configuration_tab',
    );

    $form['header_config_group']['arcade_header_override_lobby_page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Lobby Page Title'),
      '#default_value' => $this->get('arcade_header_override_lobby_page_title'),
      '#required' => FALSE,
      '#translatable' => true
    );

    $form['header_config_group']['arcade_header_override_logo_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Logo Title'),
      '#description' => $this->t('The title attribute for the main logo.'),
      '#default_value' => $this->get('arcade_header_override_logo_title'),
      '#required' => FALSE,
      '#translatable' => true
    );

    $this->registrationSettings($form);
  }

  private function registrationSettings(&$form) {
    $form['header_config_group']['registration'] = [
      '#type' => 'details',
      '#title' => $this->t('Registration'),
      '#description' => $this->t('Registration header config override for arcade.'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['header_config_group']['registration']['arcade_header_override_reg_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Join Now Button Text'),
      '#description' => $this->t('This field will be used as the join now link for arcade site.'),
      '#default_value' => $this->get('arcade_header_override_reg_label'),
      '#required' => FALSE,
      '#translatable' => true
    );

    $form['header_config_group']['registration']['arcade_header_override_reg_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Registration Link'),
      '#description' => $this->t('This field will be used as the join now link for arcade site.'),
      '#default_value' => $this->get('arcade_header_override_reg_link'),
      '#required' => FALSE,
      '#translatable' => true
    );
  }
}
