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
      '#title' => $this->t('Enable Call Us button'),
      '#default_value' => $this->get('enabled'),
      '#description' => $this->t('Show/hide Call Us button. Default value is "Disabled".'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['link_url'] = [
      '#rows' => 3,
      '#type' => 'textarea',
      '#title' => $this->t('Button URL'),
      '#default_value' => $this->get('link_url'),
      '#description' => $this->t('Please add the URL of the button. "/linkto:avaya" for avaya chat or the url of the call us page'),
      '#translatable' => TRUE,
      '#required' => true,
    ];

    $form['call_us_configation']['link_param'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Parameter'),
      '#default_value' => $this->get('link_param'),
      '#description' => $this->t('For additional parameter for the link'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['link_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Class'),
      '#default_value' => $this->get('link_class'),
      '#description' => $this->t('For additional class for the link'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Text'),
      '#default_value' => $this->get('link_text'),
      '#description' => $this->t('The text that will appear alongside the button.'),
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

    $form['call_us_configation']['exclude_page'] = [
      '#rows' => 3,
      '#type' => 'textarea',
      '#title' => $this->t('Exclude Pages'),
      '#default_value' => $this->get('exclude_page'),
      '#description' => $this->t("Specify exclude pages by using their paths. Enter one path per line. The '*' character is a wildcard. An example path is /promotion/* for every user page."),
      '#translatable' => TRUE,
      '#required' => true,
    ];

    return $form;
  }

}
