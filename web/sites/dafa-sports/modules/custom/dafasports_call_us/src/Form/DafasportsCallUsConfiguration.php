<?php

namespace Drupal\dafasports_call_us\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "dafasports_call_us",
 *   route = {
 *     "title" = "Dafa Sports Call Us Configuration",
 *     "path" = "/admin/config/webcomposer/config/callus",
 *   },
 *   menu = {
 *     "title" = "Dafa Sports Call Us Configuration",
 *     "description" = "Provides Dafa Sports Call Us configuration",
 *     "parent" = "dafasports_call_us.list",
 *     "weight" = 30
 *   },
 * )
 */
class DafasportsCallUsConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['dafasports_call_us.call_us_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['call-us'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['call_us_configation'] = [
      '#group' => 'call-us',
      '#type' => 'details',
      '#title' => 'Configuration',
    ];

    $form['call_us_configation']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Dafa Sports Call Us button'),
      '#default_value' => $this->get('enabled'),
      '#description' => $this->t('Show/hide Dafa Sports Call Us button'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['base_url'] = [
      '#rows' => 3,
      '#type' => 'textarea',
      '#title' => $this->t('Dafa Sports Call Us Base URL'),
      '#default_value' => $this->get('base_url'),
      '#description' => $this->t('Link for Dafa Sports Call Us.'),
      '#translatable' => TRUE,
      '#required' => true,
    ];

    $form['call_us_configation']['button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dafa Sports Call Us Button Text'),
      '#default_value' => $this->get('button_text'),
      '#description' => $this->t('Text for Dafa Sports Call Us Button.'),
      '#translatable' => TRUE,
      '#required' => true,
    ];

    $form['call_us_configation']['file_image_init_icon'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Initial Call Us icon'),
      '#default_value' => $this->get('file_image_init_icon'),
      '#upload_location' => 'public://',
      '#required' => true,
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['call_us_configation']['file_image_expanded_icon'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Expanded Call Us icon'),
      '#default_value' => $this->get('file_image_expanded_icon'),
      '#upload_location' => 'public://',
      '#required' => true,
      '#translatable' => false,
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    return $form;
  }

}
