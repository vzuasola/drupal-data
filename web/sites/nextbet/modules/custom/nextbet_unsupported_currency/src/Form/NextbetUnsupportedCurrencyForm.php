<?php

namespace Drupal\nextbet_unsupported_currency\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Unsupported currency configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_unsupported_currency",
 *   route = {
 *     "title" = "Unsupported Currency Configuration",
 *     "path" = "/admin/config/nextbet/config/nextbet_unsupported_currency",
 *   },
 *   menu = {
 *     "title" = "Unsupported Currency Configuration",
 *     "description" = "Provides configuration for unsupported currency across all products.",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class NextbetUnsupportedCurrencyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nextbet_unsupported_currency.unsupported_currency_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['unsupported_currency_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unsupported Currency Title'),
      '#default_value' => $this->get('unsupported_currency_title'),
      '#required' => false,
      '#translatable' => false,
    ];

    $form['file_image_unsupported_currency'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Unsupported Currency Icon'),
      '#default_value' => $this->get('file_image_unsupported_currency'),
      '#upload_location' => 'public://',
      '#required' => true,
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['unsupported_currency_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Unsupported Currency Message'),
      '#description' => $this->t('Content'),
      '#default_value' => $this->get('unsupported_currency_content')['value'],
      '#required' => false,
      '#translatable' => true,
    ];

    $form['unsupported_currency_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Unsupported Currency Mapping'),
      '#description' => $this->t('Provide the list of currency that the site does not support to show the unsupported currency page.'),
      '#default_value' => $this->get('unsupported_currency_list'),
      '#required' => true,
      '#translatable' => false,
    ];

    return $form;
  }
}
