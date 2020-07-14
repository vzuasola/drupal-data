<?php

namespace Drupal\nextbet_unsupported_currency\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_unsupported_currency",
 *   route = {
 *     "title" = "Unsupported Currency Configuration",
 *     "path" = "/admin/config/nextbet/unsupported-currency/configuration",
 *   },
 *   menu = {
 *     "title" = "Unsupported Currency Configuration",
 *     "description" = "Provides configuration for unsupported currency across all products.",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class UnsupportedCurrencyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nextbet_unsupported_currency.unsupported_currency'];
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

    $form['supported_currency_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Currency List'),
      '#description' => $this->t('Provide the list of currencies that the site support to not show the unsupported currency page.'),
      '#default_value' => $this->get('supported_currency_list'),
      '#required' => true,
      '#translatable' => false,
    ];

    return $form;
  }
}
