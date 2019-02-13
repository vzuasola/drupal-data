<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "unsupported_page",
 *   route = {
 *     "title" = "Unsupported Page",
 *     "path" = "/admin/config/owsports/unsupported-page",
 *   },
 *   menu = {
 *     "title" = "Unsupported Page",
 *     "description" = "Provides Unsupported Page and Currency Page configuration",
 *     "parent" = "owsports_configs.list",
 *     "weight" = 31
 *   },
 * )
 */

class UnsupportedPageForm extends FormBase {
    /**
     * {@inheritdoc}
     */
  protected function getEditableConfigNames() {
    return ['owsports_config.unsupported_page'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['unsupported_settings_tab'] = [
      '#title' => $this->t('Unsupported Page Settings'),
      '#type' => 'vertical_tabs',
    ];

    $this->sectionSupportedCountry($form);
    $this->sectionSupportedCurrency($form);
    return $form;
  }

/**
 *
 */
  private function sectionSupportedCountry(array &$form) {
    $form['country'] = [
      '#type' => 'details',
      '#title' => $this->t('Country Page Content'),
      '#group' => 'unsupported_settings_tab',
    ];

    $form['country']['unsupported_country_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('unsupported_country_title'),
      '#required' => false,
      '#translatable' => true,
    ];

    $form['country']['file_image_unsupported_country'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $this->get('file_image_unsupported_country'),
      '#upload_location' => 'public://',
      '#required' => false,
      '#translatable' => true,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['country']['unsupported_country_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('Content'),
      '#default_value' => $this->get('unsupported_country_content')['value'],
      '#required' => false,
      '#translatable' => true,
    ];

    $form['country_list'] = [
      '#type' => 'details',
      '#title' => $this->t('Supported Country List'),
      '#group' => 'unsupported_settings_tab',
    ];

    $form['country_list']['country'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Country List'),
      '#description' => $this->t('Define the supported countries of OW Sports, one per line.'),
      '#default_value' => $this->get('country'),
      '#required' => false,
      '#translatable' => true,
    ];
  }


  /**
   *
   */
  private function sectionSupportedCurrency(array &$form) {
    $form['currency'] = [
      '#type' => 'details',
      '#title' => $this->t('Currency Page Content'),
      '#group' => 'unsupported_settings_tab',
    ];

    $form['currency']['unsupported_currency_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('unsupported_currency_title'),
      '#required' => false,
      '#translatable' => true,
    ];

    $form['currency']['file_image_unsupported_currency'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $this->get('file_image_unsupported_currency'),
      '#upload_location' => 'public://',
      '#required' => false,
      '#translatable' => true,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['currency']['unsupported_currency_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('Content'),
      '#default_value' => $this->get('unsupported_currency_content')['value'],
      '#required' => false,
      '#translatable' => true,
    ];

    $form['currency_list'] = [
      '#type' => 'details',
      '#title' => $this->t('Supported Currencies'),
      '#group' => 'unsupported_settings_tab',
    ];

    $form['currency_list']['currency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency List'),
      '#description' => $this->t('Define the supported currencies of OW Sports, one per line.'),
      '#default_value' => $this->get('currency'),
      '#required' => false,
      '#translatable' => true,
    ];
  }
}