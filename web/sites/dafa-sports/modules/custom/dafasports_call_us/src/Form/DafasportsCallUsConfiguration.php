<?php

namespace Drupal\dafasports_call_us\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "dafasports_call_us_configuration",
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
      '#title' => $this->t('Show/hide Dafa Sports Call Us button'),
      '#default_value' => $this->get('enabled'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['base_url'] = [
      '#rows' => 3,
      '#type' => 'textarea',
      '#title' => $this->t('Dafa Sports Call Us Base URL'),
      '#default_value' => $this->get('base_url'),
      '#description' => $this->t('Link for Dafa Sports Call Us.'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dafa Sports Call Us Button Text'),
      '#default_value' => $this->get('button_text'),
      '#description' => $this->t('Text for Dafa Sports Call Us Button.'),
      '#translatable' => TRUE,
    ];

    $form['call_us_configation']['init_icon'] = [
      '#title' => $this->t('Initial call us icon'),
      '#type' => 'managed_file',
      '#description' => $this->t("Icon for minimized call us button"),
      '#default_value' => $this->get('init_icon'),
      '#upload_location' => 'public://images/call-us/',
    ];

    $form['call_us_configation']['extended_icon'] = [
      '#title' => $this->t('Extended call us icon'),
      '#type' => 'managed_file',
      '#description' => $this->t("Icon for extended call us button"),
      '#default_value' => $this->get('extended_icon'),
      '#upload_location' => 'public://images/call-us/',
    ];

    return $form;
  }

}
