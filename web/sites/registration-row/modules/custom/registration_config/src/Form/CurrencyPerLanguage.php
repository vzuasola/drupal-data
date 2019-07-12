<?php

namespace Drupal\registration_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration for Registration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "currency_per_language",
 *   route = {
 *     "title" = "Currency per Language Configuration",
 *     "path" = "/admin/config/registration/currency-language",
 *   },
 *   menu = {
 *     "title" = "Currency per Language Configuration",
 *     "description" = "Currency per Language Configuration",
 *     "parent" = "registration_config.list",
 *   },
 * )
 */
class CurrencyPerLanguage extends FormBase {

	/**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['registration_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['step_one_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Step one text'),
      '#description' => $this->t('Text that will be displayed at the top of the form'),
      '#default_value' => $this->get('step_one_text'),
    ];

    return $form;
  }
}
