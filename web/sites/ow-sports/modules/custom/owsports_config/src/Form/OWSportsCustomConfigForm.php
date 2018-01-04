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

    $form['owsports_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('General Config'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['owsports_config_group']['iframe_container'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Container ID'),
      '#description' => $this->t('ID of iFrame container.'),
      '#default_value' => $config->get('iframe_container'),
    ];

    $form['owsports_config_group']['pre_transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Transaction Subdomain'),
      '#description' => $this->t('Pre-transactions subdomain.'),
      '#default_value' => $config->get('pre_transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['post_transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Transaction Subdomain'),
      '#description' => $this->t('Post-transactions subdomain.'),
      '#default_value' => $config->get('post_transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Language conversion from Drupal to OneWorks language.'),
      '#default_value' => $config->get('language_mapping'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['act_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Bet Type Mapping'),
      '#description' => $this->t('Bet Type Mapping. e.g. act={keyword}'),
      '#default_value' => $config->get('act_mapping'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['override_domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Override Domain'),
      '#description' => $this->t('Override the domain to be used as a target. Add the domain name only, no need to add the protocol.'),
      '#default_value' => $config->get('override_domain'),
    ];

    $form['owsports_config_group']['legacy_cdn'] = [
      '#type' => 'select',
      '#title' => $this->t('Legacy CDN Source'),
      '#description' => $this->t('Legacy iFrame CDN environment source.'),
      '#options' => [$this->t('QA1'), $this->t('TCT'), $this->t('UAT'), $this->t('STG'), $this->t('PRD')],
      '#default_value' => $config->get('legacy_cdn'),
    ];

    $form['jackpotbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot Bet'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['jackpotbet_config_group']['colossus_pre_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-login'),
      '#description' => $this->t('Pre Login URI.'),
      '#default_value' => $config->get('colossus_pre_uri'),
    ];

    $form['jackpotbet_config_group']['colossus_post_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-login'),
      '#description' => $this->t('Post Login URI.'),
      '#default_value' => $config->get('colossus_post_uri'),
    ];

    $form['asia_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Asia Template (Default)'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['asia_config_group']['pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('pre_login_uri'),
      '#required' => TRUE,
    ];

    $form['asia_config_group']['post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('post_login_uri'),
      '#required' => TRUE,
    ];

    $form['euro_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Euro Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['euro_config_group']['euro_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('euro_pre_login_uri')
    ];

    $form['euro_config_group']['euro_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('euro_post_login_uri'),
    ];

    $form['euro_config_group']['euro_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Template'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=1" to the query string.'),
      '#default_value' => $config->get('euro_template'),
    ];

    $form['singbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Singbet Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['singbet_config_group']['singbet_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_pre_login_uri'),
    ];

    $form['singbet_config_group']['singbet_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_post_login_uri'),
    ];

    $form['singbet_config_group']['singbet_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Template'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=2" to the query string.'),
      '#default_value' => $config->get('singbet_template'),
    ];

    $form['right_side_block'] = [
      '#type' => 'details',
      '#title' => $this->t('Right Side Block Config'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['right_side_block']['exclude_these_page'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Exclude These Pages'),
      '#description' => $this->t('List the pages, that right side block should be hide.'),
      '#default_value' => $config->get('exclude_these_page'),
    ];

    $form['right_side_block']['euro_asia_switch'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Switch to Asia Link'),
      '#description' => $this->t('Add link for switch to asia.'),
      '#default_value' => $config->get('euro_asia_switch'),
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
      'iframe_container',
      'pre_transaction_subdomain',
      'pre_login_uri',
      'post_transaction_subdomain',
      'post_login_uri',
      'language_mapping',
      'euro_template',
      'euro_pre_login_uri',
      'euro_post_login_uri',
      'singbet_pre_login_uri',
      'singbet_post_login_uri',
      'singbet_template',
      'override_domain',
      'colossus_pre_uri',
      'colossus_post_uri',
      'cdn_mapping',
      'act_mapping',
      'legacy_cdn',
      'exclude_these_page',
      'euro_asia_switch'
    ];

    foreach ($keys as $key) {
      $this->config('owsports_config.owsports_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
