<?php

namespace Drupal\webcomposer_mobile_menu\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Mobile Menu Configuration.
 */
class MobileMenuConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.mobile_menu_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mobile_menu_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.mobile_menu_config');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Mobile Menu Configuration'),
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['general']['mobile_menu_language_lightbox_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language lightbox title'),
      '#default_value' => $config->get('mobile_menu_language_lightbox_title'),
      '#required' => TRUE,
    ];

    // User Account Group.
    $form['account'] = [
      '#type' => 'details',
      '#title' => $this->t('User account links'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
      '#description' => $this->t('Cashier and My Account buttons menu'),
    ];

    // Cashier Link.
    $form['account']['mobile_menu_cashier_links_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier label'),
      '#default_value' => $config->get('mobile_menu_cashier_links_label'),
    ];

    $form['account']['mobile_menu_cashier_links'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Links'),
      '#default_value' => $config->get('mobile_menu_cashier_links'),
      '#description' => $this->t('Enter cashier URL'),
      '#maxlength' => 256,
    ];

    // Promotion Link.
    $form['account']['mobile_menu_promotion_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Label'),
      '#default_value' => $config->get('mobile_menu_promotion_label'),
    ];

    $form['account']['mobile_menu_promotion_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion  Links'),
      '#default_value' => $config->get('mobile_menu_promotion_url'),
      '#description' => $this->t('Enter promotion URL'),
      '#maxlength' => 256,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'mobile_menu_language_lightbox_title',
      'mobile_menu_cashier_links_label',
      'mobile_menu_cashier_links',
      'mobile_menu_promotion_label',
      'mobile_menu_promotion_url',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.mobile_menu_config')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }

}
