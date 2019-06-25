<?php

namespace Drupal\webcomposer_affilates\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Affiliate Configuration.
 */
class AffiliateConfiguration extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.affiliate_configuration'];
  }

  /**
   * Aff configuration plugin
   *
   * @WebcomposerConfigPlugin(
   *   id = "affiliate_settings_form",
   *   route = {
   *     "title" = "Affiliates Configuration",
   *     "path" = "/admin/config/webcomposer/config/affiliates/config",
   *   },
   *   menu = {
   *     "title" = "Affiliates Configuration",
   *     "description" = "Provides Affiliates Configuration",
   *     "parent" = "webcomposer_affiliates.list",
   *   },
   * )
   */
  public function form(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.affiliate_configuration');

    $form['affiliate_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Affiliate Settings'),
    ];

    $form['affiliate_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Expiration'),
      '#collapsible' => TRUE,
      '#group' => 'affiliate_settings_tab',
    ];

    $form['affiliate_group']['affiliate_expiration'] = [
      '#type' => 'number',
      '#title' => $this->t('Expiration Time'),
      '#description' => $this->t('The expiration time of the Tracking variables in Minutes.'),
      '#default_value' => $config->get('affiliate_expiration'),
      '#required' => TRUE,
    ];

    return $form;
  }
}
