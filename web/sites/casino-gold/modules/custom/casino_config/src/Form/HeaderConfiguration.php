<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides configuration settings form for Header Element Configuration.
 */
class HeaderConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.header_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'header_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('casino_config.header_config');

    $form['header_settings_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );
    $form['join_now_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Join Now Button Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['join_now_group']['join_now_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Join Now Button Text'),
      '#description' => $this->t('The text to be displayed on the Join Now Button.'),
      '#default_value' => $config->get('join_now_text'),
      '#required' => TRUE,
    );
    $form['join_now_group']['join_now_link'] = array(
      '#type' => 'url',
      '#title' => $this->t('Join Now Link'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button.'),
      '#default_value' => $config->get('join_now_link'),
      '#required' => TRUE,
    );
    $form['login_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Login Issue Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',

    );
    $form['login_group']['login_issue_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Login Issue Text'),
      '#description' => $this->t('The text to be displayed on User Login Issue.'),
      '#default_value' => $config->get('login_issue_text'),
      '#required' => TRUE,
    );
    $form['login_group']['login_issue_link'] = array(
      '#type' => 'url',
      '#title' => $this->t('Login Issue Link'),
      '#description' => $this->t('The link for user redirection when clicked on Login Issue Text.'),
      '#default_value' => $config->get('login_issue_link'),
      '#required' => TRUE,
    );
    $form['lang_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Language Switcher Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['lang_group']['sc_lang_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Text for simplified chinese langauge'),
      '#description' => $this->t('Text for simplified chinese langauge'),
      '#default_value' => $config->get('sc_lang_text'),
      '#required' => TRUE,
    );
    $form['lang_group']['ch_lang_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Text for Traditional chinese langauge'),
      '#description' => $this->t('Text for traditional chinese langauge.'),
      '#default_value' => $config->get('ch_lang_text'),
      '#required' => TRUE,
    );
    $form['balance_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Balance Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['balance_group']['balance_error_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Balance Error Message.'),
      '#description' => $this->t('Balance Error Message.'),
      '#default_value' => $config->get('balance_error_text'),
      '#required' => TRUE,
    );
    $form['header_icon_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Header Icon Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['header_icon_group']['cashier_icon_hover_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Icon Hover Text.'),
      '#description' => $this->t('Cashier Icon Hover Text.'),
      '#default_value' => $config->get('cashier_icon_hover_text'),
      '#required' => TRUE,
    );
    $form['header_icon_group']['profile_icon_hover_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('My Profile Icon Hover Text.'),
      '#description' => $this->t('My Profile Icon Hover Text.'),
      '#default_value' => $config->get('profile_icon_hover_text'),
      '#required' => TRUE,
    );

    $form['newtag_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('New Tag Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['newtag_group']['product_menu_new_tag'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('New tag text'),
      '#description' => $this->t('New tag text'),
      '#default_value' => $config->get('product_menu_new_tag'),
      '#required' => TRUE,
    );
    $form['welcome_text_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Welcome Text Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['welcome_text_group']['welcome_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Welcome Text'),
      '#description' => $this->t('{username} will be replaced with account username'),
      '#default_value' => $config->get('welcome_text'),
      '#required' => TRUE,
    );
    $form['welcome_text_group']['profile_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Profile Link'),
      '#description' => $this->t('Profile Link'),
      '#default_value' => $config->get('profile_link'),
      '#required' => TRUE,
    );


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = array(
      'join_now_text',
      'join_now_link',
      'login_issue_text',
      'login_issue_link',
      'sc_lang_text',
      'ch_lang_text',
      'balance_error_text',
      'profile_icon_hover_text',
      'cashier_icon_hover_text',
      'product_menu_new_tag',
      'welcome_text',
      'profile_link',
    );
    foreach ($keys as $key) {
      $this->config('casino_config.header_config')->set($key, $form_state->getValue($key))->save();
    }
    return parent::submitForm($form, $form_state);
  }

}
