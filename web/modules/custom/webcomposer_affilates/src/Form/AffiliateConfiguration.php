<?php

namespace Drupal\webcomposer_affilates\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Affiliate Configuration.
 */
class AffiliateConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.affiliate_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'affiliate_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.affiliate_configuration');

    $form['affiliate_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['affiliate_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Affiliates Settings'),
      '#collapsible' => TRUE,
      '#group' => 'affiliate_settings_tab',
    ];

    $form['affiliate_group']['affiliate_expiration'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Affiliate Parameter expiration'),
      '#description' => $this->t('The expiration time of the Tracking variables in Minutes.'),
      '#default_value' => $config->get('affiliate_expiration'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'affiliate_expiration',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.affiliate_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
