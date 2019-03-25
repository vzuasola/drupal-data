<?php
namespace Drupal\webcomposer_games\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Unsupported Country Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_country_form",
 *   route = {
 *     "title" = "Unsupported Country Configuration",
 *     "path" = "/admin/config/webcomposer/games/unsupported-country",
 *   },
 *   menu = {
 *     "title" = "Unsupported Country Configuration",
 *     "description" = "Provides configuration for unsupported country lightbox",
 *     "parent" = "webcomposer_games.list",
 *     "weight" = 9
 *   },
 * )
 */
class UnsupportedCountryConfiguration extends FormBase {
  /**
   * @inheritdoc
   */
  /**
   * Unsupported Country Configuration definitions
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.unsupported_country'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['unsupported_country_configuration_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->generalConfig($form);
    return $form;
  }

  private function generalConfig(&$form) {

    $form['gen_config']['unsupported_country_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Restricted Country Lightbox Title'),
      '#default_value' => $this->get('unsupported_country_title'),
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['unsupported_country_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Restricted Country Lightbox Message'),
      '#default_value' => $this->get('unsupported_country_message')['value'],
      '#required' => false,
      '#translatable' => TRUE,
    ];

    $form['gen_config']['unsupported_country_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Restricted Country Lightbox Button Text'),
      '#description' => $this->t('Text inside the RCL button'),
      '#default_value' => $this->get('unsupported_country_button'),
      '#required' => false,
      '#translatable' => TRUE,
    ];
  }
}
