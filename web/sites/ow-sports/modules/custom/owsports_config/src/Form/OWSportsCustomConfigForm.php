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

    $form['owsports_config_group']['transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Transaction Subdomain'),
      '#description' => $this->t('transactions subdomain.'),
      '#default_value' => $config->get('transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Language conversion from Drupal to OneWorks language.'),
      '#default_value' => $config->get('language_mapping'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['url_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iFrame URL parameters'),
      '#description' => $this->t('query parameters for iFrame. To add use key=value, keyword|key=value'),
      '#default_value' => $config->get('url_param'),
    ];

    $form['jackpotbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot Bet'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['jackpotbet_config_group']['colossus_login_lightbox'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Launch login lightbox on pre-login'),
      '#default_value' => $config->get('colossus_login_lightbox'),
    ];

    $form['jackpotbet_config_group']['colossus_pre_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-login'),
      '#description' => $this->t('Pre Login URI.'),
      '#default_value' => $config->get('colossus_pre_uri'),
      '#required' => TRUE,
    ];

    $form['jackpotbet_config_group']['colossus_post_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-login'),
      '#description' => $this->t('Post Login URI.'),
      '#default_value' => $config->get('colossus_post_uri'),
      '#required' => TRUE,
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

    $form['asia_config_group']['how_to_bet_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How to bet URI'),
      '#default_value' => $config->get('how_to_bet_uri'),
    ];

    $form['euro_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Euro Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['euro_config_group']['euro_default_asia'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Asia template as default'),
      '#default_value' => $config->get('euro_default_asia')
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
      '#title' => $this->t('Supported Language'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=1" to the query string.'),
      '#default_value' => $config->get('euro_template'),
    ];

    $form['singbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Singbet Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['singbet_config_group']['singbet_default_asia'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Asia template as default'),
      '#default_value' => $config->get('singbet_default_asia')
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
      '#title' => $this->t('Supported Language'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=2" to the query string.'),
      '#default_value' => $config->get('singbet_template'),
    ];

    $form['right_side_block_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Right Side Block'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['right_side_block_group']['right_side_block'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Right Side Block'),
      '#default_value' => $config->get('right_side_block'),
      '#description' => $this->t('Enable this feature to hide the right side block below 1330px and lower width of screen.'),
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
      'how_to_bet_uri',
      'transaction_subdomain',
      'pre_login_uri',
      'post_login_uri',
      'language_mapping',
      'euro_default_asia',
      'euro_template',
      'euro_pre_login_uri',
      'euro_post_login_uri',
      'euro_switch_redirect',
      'singbet_default_asia',
      'singbet_pre_login_uri',
      'singbet_post_login_uri',
      'singbet_template',
      'colossus_pre_uri',
      'colossus_post_uri',
      'colossus_login_lightbox',
      'url_param',
      'right_side_block',
    ];

    foreach ($keys as $key) {
      $this->config('owsports_config.owsports_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
