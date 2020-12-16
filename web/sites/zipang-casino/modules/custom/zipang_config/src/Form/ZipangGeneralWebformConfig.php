<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_general_webform",
 *   route = {
 *     "title" = "General Webform Configuration",
 *     "path" = "/admin/config/zipang/general_webform_configuration",
 *   },
 *   menu = {
 *     "title" = "General Webform Configuration",
 *     "description" = "Provides General Webform configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangGeneralWebformConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.general_webform_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('General Webform Configuration'),
    ];

    $this->sectionConfirmationMessage($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionConfirmationMessage(array &$form) {
    $form['confirmation_message'] = [
      '#type' => 'details',
      '#title' => t('Confirmation Message Before Submission Setting'),
      '#group' => 'advanced',
    ];

    $form['confirmation_message']['confirmation_enable'] = [
        '#type' => 'checkbox',
        '#title' => 'Enable Confirmation Message',
        '#description' => $this->t('Show/hide confirmation message lightbox before submission of webform. 
                                    <br/><strong>Note: This will apply to all webforms </strong>'),
        '#default_value' => $this->get('confirmation_enable'),
        '#translatable' => TRUE,
      ];

    $form['confirmation_message']['confirmation_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Confirmation Lightbox Title'),
      '#default_value' => $this->get('confirmation_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('confirmation_content');
    $form['confirmation_message']['confirmation_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Confirmation Message Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['confirmation_message']['submit_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Submit Button Label'),
      '#default_value' => $this->get('submit_label'),
      '#translatable' => TRUE,
    ];

    $form['confirmation_message']['cancel_label'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Cancel Button Label'),
        '#default_value' => $this->get('cancel_label'),
        '#translatable' => TRUE,
      ];
  }
}
