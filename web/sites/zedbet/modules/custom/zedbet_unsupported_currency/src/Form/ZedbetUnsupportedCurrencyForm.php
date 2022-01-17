<?php

namespace Drupal\zedbet_unsupported_currency\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Unsupported currency configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zedbet_unsupported_currency",
 *   route = {
 *     "title" = "Unsupported Currency Configuration",
 *     "path" = "/admin/config/zedbet/config/zedbet_unsupported_currency",
 *   },
 *   menu = {
 *     "title" = "Unsupported Currency Configuration",
 *     "description" = "Provides configuration for unsupported currency across all products.",
 *     "parent" = "zedbet_config.list",
 *   },
 * )
 */
class ZedbetUnsupportedCurrencyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zedbet_unsupported_currency.unsupported_currency_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['file_image_unsupported_currency'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Unsupported Currency Icon'),
      '#default_value' => $this->get('file_image_unsupported_currency'),
      '#upload_location' => 'public://',
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
      '#required' => false,
      '#translatable' => false,
    ];

    return $form;
  }
}
