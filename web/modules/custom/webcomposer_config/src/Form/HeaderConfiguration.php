<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class HeaderConfiguration extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.header_configuration'];
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
    $config = $this->config('webcomposer_config.header_configuration');

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
      '#type' => 'textfield',
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
      '#type' => 'textfield',
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

    // for default display in text format and text area.

    $default_news_announcement = $config->get('news_announcement_content');

    $default_critical_announcement = $config->get('critical_announcement_content');


    $form['announcement_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Announcement Bar'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );

    $form['announcement_group']['critical_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('Critical Issues'),
    ];

    $form['announcement_group']['critical_issue']['critical_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Critical Issue announcements',
      '#description' => $this->t('Show/hide Critical Issue announcement. Default value is "Enabled".'),
      '#default_value' => $config->get('critical_announcement'),

    ];

    $form['announcement_group']['critical_issue']['critical_announcement_content'] = [
      '#type' => 'text_format',
      '#title' => t('Announcement Content'),
      '#default_value' => $default_critical_announcement['value'],
      '#description' => $this->t('NOTE: Announcement content must not be empty and announcement must be enabled to show announcement.'),
      '#format' => $default_critical_announcement['format'],
      '#states' => [
        'invisible' => [
          'input[name="critical_announcement"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['announcement_group']['news_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('News'),
    ];

    $form['announcement_group']['news_issue']['news_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable news announcements',
      '#description' => $this->t('Show/hide news announcement. Default value is "Enabled".'),
      '#default_value' => $config->get('news_announcement'),

    ];

    $form['announcement_group']['news_issue']['news_announcement_content'] = [
      '#type' => 'text_format',
      '#title' => t('News Content'),
      '#description' => $this->t('NOTE: Announcement content must not be empty and announcement must be enabled to show announcement.'),
      '#default_value' => $default_news_announcement['value'],
      '#format' => $default_news_announcement['format'],
      '#states' => [
        'invisible' => [
          'input[name="news_announcement"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['header_other_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Other Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );

    $form['header_other_group']['lobby_page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Lobby Page Title.'),
      '#description' => $this->t('Lobby Page Title.'),
      '#default_value' => $config->get('lobby_page_title'),
      '#required' => TRUE,
    );

    $form['header_other_group']['profile_logout_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Logout Link Text.'),
      '#description' => $this->t('Logout Link Text.'),
      '#default_value' => $config->get('profile_logout_text'),
      '#required' => TRUE,
    );

    $form['header_other_group']['cashier_icon_hover_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Icon Hover Text.'),
      '#description' => $this->t('Cashier Icon Hover Text.'),
      '#default_value' => $config->get('cashier_icon_hover_text'),
      '#required' => TRUE,
    );

    $form['header_other_group']['profile_icon_hover_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('My Profile Icon Hover Text.'),
      '#description' => $this->t('My Profile Icon Hover Text.'),
      '#default_value' => $config->get('profile_icon_hover_text'),
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
      'lobby_page_title',
      'profile_icon_hover_text',
      'cashier_icon_hover_text',
      'product_menu_new_tag',
      'welcome_text',
      'critical_announcement',
      'critical_announcement_content',
      'news_announcement',
      'news_announcement_content',
      'profile_link',
      'profile_logout_text',
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_config.header_configuration')->set($key, $form_state->getValue($key))->save();
    }
    
    return parent::submitForm($form, $form_state);
  }

}
