<?php

namespace Drupal\mobile_owsports\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_owsports",
 *   route = {
 *     "title" = "OWSports Configuration",
 *     "path" = "/admin/config/mobile/owsports/configuration",
 *   },
 *   menu = {
 *     "title" = "OWSports Configuration",
 *     "description" = "Provides configuration for OWSports",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class OWSportsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_owsports.owsports_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['integration']['smart_wap'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Smart WAP URL'),
      '#default_value' => $this->get('smart_wap'),
      '#translatable' => TRUE,
    ];

    $form['integration']['iwap'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iWAP URL'),
      '#default_value' => $this->get('iwap'),
      '#translatable' => TRUE,
    ];

    $form['integration']['owsports_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('OWSports URL Params'),
      '#default_value' => $this->get('owsports_param'),
      '#translatable' => TRUE,
    ];

    $form['integration']['owsports_param_encode'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Encode OWSports URL Params'),
      '#default_value' => $this->get('owsports_param_encode'),
      '#translatable' => TRUE,
    ];

    $form['integration']['smart_wap_prelogin'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Smart WAP Prelogin URL'),
      '#default_value' => $this->get('smart_wap_prelogin'),
      '#translatable' => TRUE,
    ];

    $form['integration']['owsports_prelogin_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('OWSports URL Params for pre login'),
      '#default_value' => $this->get('owsports_prelogin_param'),
      '#translatable' => TRUE,
    ];

    $form['integration']['owsports_prelogin_param_encode'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Encode OWSports Prelogin URL Params'),
      '#default_value' => $this->get('owsports_prelogin_param_encode'),
      '#translatable' => TRUE,
    ];

    $form['integration']['iwap_agents'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iWAP Mobile Agents'),
      '#default_value' => $this->get('iwap_agents'),
      '#translatable' => TRUE,
    ];
    return $form;
  }
}
