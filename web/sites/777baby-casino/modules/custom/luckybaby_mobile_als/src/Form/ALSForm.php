<?php

namespace Drupal\luckybaby_mobile_als\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "luckybaby_mobile_als",
 *   route = {
 *     "title" = "Lucky Baby ALS Configuration",
 *     "path" = "/admin/config/lucky_baby/mobile_als_configuration",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby ALS Configuration",
 *     "description" = "Provides configuration for ALS Lucky Baby Mobile",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *   },
 * )
 */
class ALSForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['luckybaby_mobile_als.als_configuration'];
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
