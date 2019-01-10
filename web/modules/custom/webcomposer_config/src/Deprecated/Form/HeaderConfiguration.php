<?php

namespace Drupal\webcomposer_config\Deprecated\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Header Configuration.
 */
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
    $form['header_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionLogo($form);
    $this->sectionJoinNow($form);
    $this->sectionLogin($form);
    $this->sectionBalance($form);
    $this->sectionNewtag($form);
    $this->sectionWelcome($form);
    $this->sectionAnnouncement($form);
    $this->sectionOther($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   *
   */
  private function sectionLogo(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['logo_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Logo'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['logo_group']['logo_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logo Title'),
      '#description' => $this->t('The title attribute for the main logo.'),
      '#default_value' => $config->get('logo_title'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionJoinNow(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['join_now_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Registration'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['join_now_group']['join_now_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Join Now Button Text'),
      '#description' => $this->t('The text to be displayed on the Join Now Button.'),
      '#default_value' => $config->get('join_now_text'),
      '#required' => TRUE,
    ];

    $form['join_now_group']['join_now_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Join Now Link'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button.'),
      '#default_value' => $config->get('join_now_link'),
      '#required' => TRUE,
      '#rows' => 1
    ];
  }

  /**
   *
   */
  private function sectionLogin(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['login_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Login'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['login_group']['password_mask_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Password Mask/Unmask'),
      '#description' => $this->t('Allow masking of the password field.'),
      '#default_value' => $config->get('password_mask_toggle'),
    ];

    $form['login_group']['caps_lock_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Caps lock Notification'),
      '#description' => $this->t('Notify user if caps lock is on when entering the password field.'),
      '#default_value' => $config->get('caps_lock_toggle'),
    ];

    $form['login_group']['capslock_notification'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Caps Lock Notification Message'),
      '#description' => $this->t('The text to be displayed when user keyboard is on.'),
      '#default_value' => $config->get('capslock_notification'),
      '#required' => TRUE,
    ];

    $form['login_group']['login_issue_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Issue Text'),
      '#description' => $this->t('The text to be displayed on User Login Issue.'),
      '#default_value' => $config->get('login_issue_text'),
      '#required' => TRUE,
    ];

    $form['login_group']['login_issue_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login Issue Link'),
      '#description' => $this->t('The link for user redirection when clicked on Login Issue Text.'),
      '#default_value' => $config->get('login_issue_link'),
      '#required' => TRUE,
      '#rows' => 1
    ];

    $form['login_group']['profile_logout_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logout Link Text.'),
      '#description' => $this->t('Logout Link Text.'),
      '#default_value' => $config->get('profile_logout_text'),
      '#required' => TRUE,
    ];

    $form['login_group']['cashier_icon_hover_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Icon Hover Text.'),
      '#description' => $this->t('Cashier Icon Hover Text.'),
      '#default_value' => $config->get('cashier_icon_hover_text'),
      '#required' => TRUE,
    ];

    $form['login_group']['profile_icon_hover_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My Profile Icon Hover Text.'),
      '#description' => $this->t('My Profile Icon Hover Text.'),
      '#default_value' => $config->get('profile_icon_hover_text'),
      '#required' => TRUE,
    ];

    $form['login_group']['cashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cashier Link'),
      '#description' => $this->t('Cashier Link For Header'),
      '#default_value' => $config->get('cashier_link'),
      '#required' => TRUE,
      '#rows' => 1
    ];
  }

  /**
   *
   */
  private function sectionBalance(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['balance_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Balance'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['balance_group']['balance_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Balance Toggle'),
      '#description' => $this->t('If checked will allow balance toggle to be visible to the players.'),
      '#default_value' => $config->get('balance_toggle'),
    ];

    $form['balance_group']['deprecated'] = [
      '#type' => 'details',
      '#title' => $this->t('Deprecated'),
      '#description' => $this->t('These are deprecated fields to support old products.'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['balance_group']['deprecated']['product_balance_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Balance Label.'),
      '#description' => $this->t('The label for the product specific balance'),
      '#default_value' => $config->get('product_balance_label'),
      '#required' => TRUE,
    ];

    $form['balance_group']['deprecated']['product_balance_id'] = [
      '#type' => 'number',
      '#title' => $this->t('Product Balance ID.'),
      '#description' => $this->t('The ID of the balance to be shown as the product balance'),
      '#default_value' => $config->get('product_balance_id'),
    ];

    $form['balance_group']['total_balance_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Total Balance Label.'),
      '#description' => $this->t('The label for the total balance'),
      '#default_value' => $config->get('total_balance_label'),
      '#required' => TRUE,
    ];

    $form['balance_group']['balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Balance Mapping'),
      '#description' => $this->t('Provide a product mapping that will show up below the username'),
      '#default_value' => $config->get('balance_mapping'),
    ];

    $form['balance_group']['balance_label_override'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lottery Balance Label Override in Tooltip'),
      '#description' => $this->t('Provide a label to override LD and Lottery label specific for SC and RMB currency'),
      '#default_value' => $config->get('balance_label_override'),
    ];

    $form['balance_group']['balance_error_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Balance Error Message.'),
      '#description' => $this->t('Balance Error Message.'),
      '#default_value' => $config->get('balance_error_text'),
      '#required' => TRUE,
    ];

    $form['balance_group']['balance_error_text_product'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Balance Error Message'),
      '#description' => $this->t('Error message for the per product balance'),
      '#default_value' => $config->get('balance_error_text_product'),
      '#required' => TRUE,
    ];

    $form['balance_group']['balance_label_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Balances Label Mapping'),
      '#description' => $this->t('Labels and ordering for the balance breakdown'),
      '#default_value' => $config->get('balance_label_mapping'),
      '#required' => TRUE,
    ];

    $form['balance_group']['currency_balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency Balance Mapping'),
      '#description' => $this->t("Define a mapping of product to currency. A product that
        appears on this configuration will be filtered according to the currencies
        defined.
        <br><br>
        Example
        <br>
        7|RMB,USD,KRW

      "),
      '#default_value' => $config->get('currency_balance_mapping'),
    ];

    $form['balance_group']['excluded_balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Excluded Balance Mapping'),
      '#description' => $this->t('Define product IDs one per line'),
      '#default_value' => $config->get('excluded_balance_mapping'),
    ];
  }

  /**
   *
   */
  private function sectionNewtag(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['newtag_group'] = [
      '#type' => 'details',
      '#title' => $this->t('New Tag'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['newtag_group']['product_menu_new_tag'] = [
      '#type' => 'textfield',
      '#title' => $this->t('New tag text'),
      '#description' => $this->t('New tag text'),
      '#default_value' => $config->get('product_menu_new_tag'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionWelcome(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['welcome_text_group'] = [
        '#type' => 'details',
        '#title' => $this->t('Welcome Text'),
        '#collapsible' => TRUE,
        '#group' => 'header_settings_tab',
      ];

      $form['welcome_text_group']['welcome_text'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Welcome Text'),
        '#description' => $this->t('{username} will be replaced with account username'),
        '#default_value' => $config->get('welcome_text'),
        '#required' => TRUE,
      ];

      $form['welcome_text_group']['profile_link'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Profile Link'),
        '#description' => $this->t('Profile Link'),
        '#default_value' => $config->get('profile_link'),
        '#required' => TRUE,
        '#rows' => 1
      ];
  }

  /**
   *
   */
  private function sectionAnnouncement(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $default_news_announcement = $config->get('news_announcement_content');
    $default_critical_announcement = $config->get('critical_announcement_content');

    $form['announcement_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Announcement Bar'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

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
  }

  /**
   *
   */
  private function sectionOther(array &$form) {
    $config = $this->config('webcomposer_config.header_configuration');

    $form['header_other_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Others'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['header_other_group']['lobby_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lobby Page Title.'),
      '#description' => $this->t('Lobby Page Title.'),
      '#default_value' => $config->get('lobby_page_title'),
      '#required' => TRUE,
    ];

    $form['header_other_group']['promotion_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Page Title.'),
      '#description' => $this->t('Promotion Page Title.'),
      '#default_value' => $config->get('promotion_page_title'),
      '#required' => TRUE,
    ];

    $form['header_other_group']['links_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Quicklinks Label'),
      '#description' => $this->t('Quicklinks Label'),
      '#default_value' => $config->get('links_title'),
      '#required' => true,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      // Logo Section
      'logo_title',

      // Join now Section
      'join_now_text',
      'join_now_link',

      // Login Section
      'password_mask_toggle',
      'caps_lock_toggle',
      'capslock_notification',
      'login_issue_text',
      'login_issue_link',
      'profile_logout_text',
      'cashier_icon_hover_text',
      'profile_icon_hover_text',
      'cashier_link',

      // Balance Section
      'balance_toggle',
      'product_balance_label',
      'total_balance_label',
      'product_balance_id',
      'balance_error_text',
      'balance_error_text_product',
      'balance_label_mapping',
      'currency_balance_mapping',
      'excluded_balance_mapping',
      'balance_label_override',
      'balance_mapping',

      // New tag Section
      'product_menu_new_tag',

      // Welcome text Section
      'welcome_text',
      'profile_link',

      // Announcement Section
      'critical_announcement',
      'critical_announcement_content',
      'news_announcement',
      'news_announcement_content',

      // Others Section
      'lobby_page_title',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.header_configuration')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}
