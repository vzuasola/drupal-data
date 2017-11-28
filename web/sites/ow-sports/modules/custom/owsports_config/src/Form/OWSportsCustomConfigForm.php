<?php

namespace Drupal\owsports_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class OWSportsCustomConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.owsports_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'owsports_config.owsports_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('owsports_config.owsports_configuration');

    $form['owsports_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['default_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['default_config_group']['subdomain_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Transaction Subdomain'),
    ];

    $form['default_config_group']['subdomain_group']['pre_transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Transaction Subdomain'),
      '#description' => $this->t('Pre-transactions subdomain.'),
      '#default_value' => $config->get('pre_transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['default_config_group']['subdomain_group']['post_transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Transaction Subdomain'),
      '#description' => $this->t('Post-transactions subdomain.'),
      '#default_value' => $config->get('post_transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['default_config_group']['login_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Login URI'),
    ];

    $form['default_config_group']['login_group']['pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('pre_login_uri'),
      '#required' => TRUE,
    ];

    $form['default_config_group']['login_group']['post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('post_login_uri'),
      '#required' => TRUE,
    ];

    $form['default_config_group']['language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Language conversion from Drupal to OneWorks language. e.g. "langcode|[querystrying_key]=[OneWorks_langcode]"'),
      '#default_value' => $config->get('language_mapping'),
      '#required' => TRUE,
    ];

    $form['default_config_group']['euro_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Euro Config'),
    ];

    $form['default_config_group']['euro_config_group']['euro_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('euro_pre_login_uri')
    ];

    $form['default_config_group']['euro_config_group']['euro_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('euro_post_login_uri'),
    ];

    $form['default_config_group']['euro_config_group']['euro_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Template'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=1" to the query string.'),
      '#default_value' => $config->get('euro_template'),
    ];

    $form['default_config_group']['singbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Singbet Config'),
    ];

    $form['default_config_group']['singbet_config_group']['singbet_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_pre_login_uri'),
    ];

    $form['default_config_group']['singbet_config_group']['singbet_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_post_login_uri'),
    ];

    $form['default_config_group']['singbet_config_group']['singbet_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Template'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=2" to the query string.'),
      '#default_value' => $config->get('singbet_template'),
    ];

    $form['default_config_group']['redirect_page_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Redirect Page URL'),
      '#description' => $this->t('Redirect link for Login Language Redirects (internal path only).'),
      '#default_value' => $config->get('redirect_page_url'),
    ];

    $form['default_config_group']['iframe_assets_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('iFrame Assets'),
    ];

    $form['default_config_group']['iframe_assets_config_group']['iframe_js_source'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Javascript'),
      '#description' => $this->t('Javascript that will be injected on iframe. e.g. selector|filename'),
      '#default_value' => $config->get('iframe_js_source'),
    ];

    $form['default_config_group']['iframe_assets_config_group']['iframe_css_source'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Stylesheet'),
      '#description' => $this->t('CSS that will be injected on iframe. e.g. selector|filename'),
      '#default_value' => $config->get('iframe_css_source'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'pre_transaction_subdomain',
      'pre_login_uri',
      'post_transaction_subdomain',
      'post_login_uri',
      'language_mapping',
      'euro_template',
      'singbet_pre_login',
      'singbet_template',
      'redirect_url',
      'iframe_js_source',
      'iframe_css_source'
    ];

    foreach ($keys as $key) {
      $this->config('owsports_config.owsports_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
