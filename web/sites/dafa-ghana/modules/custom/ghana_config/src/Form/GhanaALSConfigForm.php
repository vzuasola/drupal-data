<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_als_config_form",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/ghana/als_configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides General configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 10
 *   },
 * )
 */

class GhanaALSConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ghana_config.als_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
        '#type' => 'vertical_tabs',
        '#title' => t('General Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form){
    $form['als_configuration_setting'] = [
      '#type' => 'details',
      '#title' => t('ALS Configuration'),
      '#group' => 'advanced',
    ];

    $form['als_configuration_setting']['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ALS URL'),
      '#default_value' => $this->get('als_url'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_cookie_url_pre'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Pre login)'),
      '#default_value' => $this->get('als_cookie_url_pre'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['integration']['als_cookie_url_post'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Post login)'),
      '#default_value' => $this->get('als_cookie_url_post'),
      '#translatable' => TRUE,
    ];

    $form['als_configuration_setting']['domains'] = [
      '#type' => 'details',
      '#title' => $this->t('Domain'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['als_configuration_setting']['domains']['als_enable_domain'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Domain Mapping'),
      '#default_value' => $this->get('als_enable_domain'),
      '#description' => 'Auto generate als domain base on the current site domain.',
      '#translatable' => TRUE,
    ];

    $form['footer_configuration_setting'] = [
      '#type' => 'details',
      '#title' => t('Footer Setting'),
      '#group' => 'advanced',
    ];

    $form['footer_configuration_setting']['ghana_footer_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('ghana_footer_title'),
      '#translatable' => TRUE,
    ];

    $c = $this->get('ghana_footer_desc');
    $form['footer_configuration_setting']['ghana_footer_desc'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Description'),
      '#default_value' => $c['value'],
      '#format' => $c['format'],
      '#translatable' => TRUE,
    ];
  }
}
