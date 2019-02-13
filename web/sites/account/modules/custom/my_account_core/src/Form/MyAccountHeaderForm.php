<?php

namespace Drupal\my_account_core\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account header configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_core.header",
 *   route = {
 *     "title" = "My Account Header Configuration",
 *     "path" = "/admin/config/my_account/header",
 *   },
 *   menu = {
 *     "title" = "My Account Header",
 *     "description" = "My Account header configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountHeaderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {

    return ['my_account_core.header'];
  }

  /**
   * Build the form.
   *
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['header'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Welcome Text',
      '#group' => 'header',
    ];

    $form['field_configuration']['welcome_text'] = [
      '#type' => 'textfield',
      '#title' => t('Welcome text'),
      '#required' => TRUE,
      '#description' => $this->t('Text for welcome text appear at the header top navigation.'),
      '#default_value' => $this->get('welcome_text'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['product_menu_new_tag'] = [
      '#type' => 'textfield',
      '#title' => t('New Tag'),
      '#required' => TRUE,
      '#description' => $this->t('Text for new tag'),
      '#default_value' => $this->get('product_menu_new_tag'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['help_tooltip'] = [
      '#type' => 'textfield',
      '#title' => t('Help Tooltip'),
      '#required' => TRUE,
      '#description' => $this->t('Tooltip for help'),
      '#default_value' => $this->get('help_tooltip'),
      '#translatable' => TRUE,
    ];
    $form['field_configuration']['error_mid_down'] = [
      '#type' => 'textarea',
      '#title' => t('Error Message MID Down'),
      '#size' => 500,
      '#required' => TRUE,
      '#description' => $this->t('General Error Message across all forms of my account if MID is down.'),
      '#default_value' => $this->get('error_mid_down'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
