<?php

namespace Drupal\webcomposer_promotions\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;

/**
 * Promotion Custom configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "promotion_configuration_form",
 *   route = {
 *     "title" = "Promotion Custom Configuration",
 *     "path" = "/admin/config/webcomposer/config/promotions-configuration",
 *   },
 *   menu = {
 *     "title" = "Promotion Custom Configuration",
 *     "description" = "Provides configuration for Promotion Custom behaviors",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class PromotionsConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.promotion_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Promotion Custom Configuration'),
    ];

    $this->sectionCustom($form);
    $this->sectionException($form);

    return $form;
  }

  /**
   *
   */
  private function sectionCustom(array &$form) {
    $form['custom'] = [
      '#type' => 'details',
      '#collapsible' => TRUE,
      '#group' => 'advanced',
      '#title' => $this->t('Custom Config'),
    ];

    $form['custom']['browser_title'] = array(
      '#size' => 64,
      '#maxlength' => 64,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#title' => $this->t('Browser Tab Title'),
      '#description' => $this->t('The Title on browser tab.'),
      '#default_value' => $this->get('browser_title'),
    );

    $form['custom']['read_more'] = array(
      '#size' => 64,
      '#maxlength' => 64,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#title' => $this->t('Read More Text'),
      '#default_value' => $this->get('read_more'),
      '#description' => $this->t('The Translated string for read more.'),
    );

    $form['custom']['countdown'] = array(
      '#size' => 64,
      '#maxlength' => 64,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#default_value' => $this->get('countdown'),
      '#title' => $this->t('Add Countdown Format'),
      '#description' => $this->t('The Translated string for countdown Format. eg: days, hours, remaining'),
    );

    $form['custom']['all_text'] = array(
      '#size' => 64,
      '#maxlength' => 64,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#default_value' => $this->get('all_text'),
      '#title' => $this->t('Product Filter All Text'),
      '#description' => $this->t('The Translated string for the `All` text on the product filter dropdown'),
    );
  }

  /**
   *
   */
  private function sectionException(array &$form) {
    $form['exception'] = [
      '#type' => 'details',
      '#collapsible' => TRUE,
      '#group' => 'advanced',
      '#title' => $this->t('Exception Config'),
    ];

    $form['exception']['exception_title'] = array(
      '#size' => 64,
      '#maxlength' => 64,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#title' => $this->t('Exception Title'),
      '#description' => $this->t('The Title on browser tab.'),
      '#default_value' => $this->get('exception_title'),
    );

    $form['exception']['file_image_exception'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Exception Image'),
      '#default_value' => $this->get('file_image_exception'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $content = $this->get('exception_content');

    $form['exception']['exception_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Exception Content'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#translatable' => TRUE,
    ];
  }
}
