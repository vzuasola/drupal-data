<?php

namespace Drupal\currency_language\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Webcomposer Currency per Language
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_currency_language",
 *   route = {
 *     "title" = "Webcomposer Currency per Language Configuration",
 *     "path" = "/admin/config/webcomposer/currency-language",
 *   },
 *   menu = {
 *     "title" = "Webcomposer Currency per Language Configuration",
 *     "description" = "Webcomposer Currency per Language Configuration",
 *     "parent" = "webcompsoer_config.list",
 *   },
 * )
 */
class CurrencyPerLanguageForm extends FormBase {

	/**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.currency_language'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['general_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Settings'),
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
      '#group' => 'general_settings_tab',
    ];

    $form['general']['step_one_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step one text'),
      '#description' => $this->t('Text that will be displayed at the top of the form'),
      '#default_value' => $this->get('step_one_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    return $form;
  }


}
