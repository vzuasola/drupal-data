<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_als_config_form",
 *   route = {
 *     "title" = "ALS Configuration",
 *     "path" = "/admin/config/ghana/als_configuration",
 *   },
 *   menu = {
 *     "title" = "ALS Configuration",
 *     "description" = "Provides ALS configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 30
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
    $form['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['integration']['als_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ALS URL'),
      '#default_value' => $this->get('als_url'),
      '#translatable' => TRUE,
    ];

    $form['integration']['als_cookie_url_pre'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Pre login)'),
      '#default_value' => $this->get('als_cookie_url_pre'),
      '#translatable' => TRUE,
    ];

    $form['integration']['als_cookie_url_post'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cookie URLs (Post login)'),
      '#default_value' => $this->get('als_cookie_url_post'),
      '#translatable' => TRUE,
    ];

    $form['domains'] = [
      '#type' => 'details',
      '#title' => $this->t('Domain'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['domains']['als_enable_domain'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Domain Mapping'),
      '#default_value' => $this->get('als_enable_domain'),
      '#description' => 'Auto generate als domain base on the current site domain.',
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
