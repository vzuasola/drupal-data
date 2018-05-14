<?php

namespace Drupal\mobile_als\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_als",
 *   route = {
 *     "title" = "ALS Configuration",
 *     "path" = "/admin/config/mobile/als/configuration",
 *   },
 *   menu = {
 *     "title" = "ALS Configuration",
 *     "description" = "Provides configuration for ALS",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class ALSForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_als.als_configuration'];
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

    return $form;
  }
}
