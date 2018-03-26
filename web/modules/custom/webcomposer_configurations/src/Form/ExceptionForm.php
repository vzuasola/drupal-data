<?php

namespace Drupal\webcomposer_configurations\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Exception configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_configurations_exception",
 *   route = {
 *     "title" = "Exception Configuration",
 *     "path" = "/admin/config/webcomposer/configurations/exception",
 *   },
 *   menu = {
 *     "title" = "Exception Configuration",
 *     "description" = "Provides configuration for exception pages",
 *     "parent" = "webcomposer_configurations.list",
 *   },
 * )
 */
class ExceptionForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.page_not_found'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Exception Configuration'),
    ];

    $form['not_found'] = [
      '#type' => 'details',
      '#title' => $this->t('Access Denied'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['not_found']['page_not_found_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('page_not_found_title'),
      '#translatable' => TRUE,
    ];

    $form['not_found']['page_not_found_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $this->get('page_not_found_image'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $content = $this->get('page_not_found_content');

    $form['not_found']['page_not_found_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
