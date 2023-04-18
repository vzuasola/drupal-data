<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_header",
 *   route = {
 *     "title" = "Header Configuration",
 *     "path" = "/admin/config/webcomposer/config/header",
 *   },
 *   menu = {
 *     "title" = "Header Configuration",
 *     "description" = "Provides configuration for header components",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class HeaderForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.header_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['header_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionLogo($form);
    $this->sectionJoinNow($form);
    $this->sectionLogin($form);
    $this->sectionMlogin($form);
    $this->sectionCashier($form);
    $this->sectionMcashier($form);
    $this->sectionBalance($form);
    $this->sectionNewtag($form);
    $this->sectionWelcome($form);
    $this->sectionAnnouncement($form);
    $this->moreMenuTranslation($form);
    $this->sectionOther($form);

    return $form;
  }

  /**
   *
   */
  private function sectionLogo(array &$form) {
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
      '#default_value' => $this->get('logo_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['logo_group']['logo_url'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Logo URL'),
      '#description' => $this->t('The link for logo redirection.'),
      '#default_value' => $this->get('logo_url'),
      '#rows' => 1,
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];

    $form['logo_group']['mobile_logo_url'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mobile Logo URL'),
      '#description' => $this->t('The link for logo redirection on mobile.'),
      '#default_value' => $this->get('mobile_logo_url'),
      '#rows' => 1,
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionJoinNow(array &$form) {
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
      '#default_value' => $this->get('join_now_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['join_now_group']['registration_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Link'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button.'),
      '#default_value' => $this->get('registration_link'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['join_now_group']['registration_link_mobile'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Registration Mobile Link'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button on mobile view.'),
      '#default_value' => $this->get('registration_link_mobile'),
      '#rows' => 1,
      '#required' => false,
      '#translatable' => true,
    ];

    $form['join_now_group']['join_now_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Join Now Link (Deprecated)'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button.'),
      '#default_value' => $this->get('join_now_link'),
      '#rows' => 1,
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionLogin(array &$form) {
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
      '#default_value' => $this->get('password_mask_toggle'),
    ];

    $form['login_group']['caps_lock_toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Caps lock Notification'),
      '#description' => $this->t('Notify user if caps lock is on when entering the password field.'),
      '#default_value' => $this->get('caps_lock_toggle'),
    ];

    $form['login_group']['capslock_notification'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Caps Lock Notification Message'),
      '#description' => $this->t('The text to be displayed when user keyboard is on.'),
      '#default_value' => $this->get('capslock_notification'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['login_issue_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Issue Text'),
      '#description' => $this->t('The text to be displayed on User Login Issue.'),
      '#default_value' => $this->get('login_issue_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['login_issue_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Login Issue Link'),
      '#description' => $this->t('The link for user redirection when clicked on Login Issue Text.'),
      '#default_value' => $this->get('login_issue_link'),
      '#rows' => 1,
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['profile_logout_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logout Link Text.'),
      '#description' => $this->t('Logout Link Text.'),
      '#default_value' => $this->get('profile_logout_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['cashier_icon_hover_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Icon Hover Text.'),
      '#description' => $this->t('Cashier Icon Hover Text.'),
      '#default_value' => $this->get('cashier_icon_hover_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['profile_icon_hover_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My Profile Icon Hover Text.'),
      '#description' => $this->t('My Profile Icon Hover Text.'),
      '#default_value' => $this->get('profile_icon_hover_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['login_group']['cashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cashier Link'),
      '#description' => $this->t('Cashier Link For Header'),
      '#default_value' => $this->get('cashier_link'),
      '#rows' => 1,
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionMlogin(array &$form) {
    $form['mlogin_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Login'),
      '#collapsible' => true,
      '#group' => 'header_settings_tab',
    ];

    $form['mlogin_group']['login_join_now_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mobile Login/Join Now Text'),
      '#description' => $this->t('The button text on mobile view.'),
      '#default_value' => $this->get('login_join_now_text'),
      '#rows' => 1,
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionCashier(array &$form) {
    $form['cashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Cashier'),
      '#collapsible' => true,
      '#group' => 'header_settings_tab',
    ];

    $form['cashier_group']['default_cashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Cashier Link'),
      '#description' => $this->t('Specify a default cashier link if no one matches the mapping'),
      '#default_value' => $this->get('default_cashier_link'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['cashier_group']['cashier_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cashier Mapping'),
      '#description' => $this->t("
        Define a cashier mapping based on the user's currency and registered country
        using the format.
        <br>
        Use upper case currency and country values (without spaces in between pipes).
        <br>
        <strong>currency | country | link</strong>
        <br><br>
        Example
        <br>
        CNY|CN|http://cashier.dafabet.com/
      "),
      '#default_value' => $this->get('cashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionMcashier(array &$form) {
    $form['mcashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Cashier'),
      '#collapsible' => true,
      '#group' => 'header_settings_tab',
    ];

    $form['mcashier_group']['default_mcashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Mobile Cashier Link'),
      '#description' => $this->t('Specify a default Mobile cashier link if no one matches the mapping'),
      '#default_value' => $this->get('default_mcashier_link'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['mcashier_group']['mcashier_link_target'] = [
      '#type' => 'select',
      '#options' => [
        '_self' => 'Same Tab',
        '_blank' => 'New Tab',
        'window' => 'New Window'
      ],
      '#title' => $this->t('Mobile Cashier Link Target'),
      '#description' => $this->t('Select a Mobile cashier link target'),
      '#default_value' => $this->get('mcashier_link_target'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['mcashier_group']['mcashier_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mobile Cashier Mapping'),
      '#description' => $this->t("
        Define a Mobile cashier mapping based on the user's currency and registered country
        using the format.
        <br>
        Use upper case currency and country values (without spaces in between pipes).
        <br>
        <strong>currency | country | link</strong>
        <br><br>
        Example
        <br>
        CNY|CN|http://mcashier.dafabet.com/
      "),
      '#default_value' => $this->get('mcashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionBalance(array &$form) {
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
      '#default_value' => $this->get('balance_toggle'),
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
      '#default_value' => $this->get('product_balance_label'),
      '#required' => TRUE,
    ];

    $form['balance_group']['deprecated']['product_balance_id'] = [
      '#type' => 'number',
      '#title' => $this->t('Product Balance ID.'),
      '#description' => $this->t('The ID of the balance to be shown as the product balance'),
      '#default_value' => $this->get('product_balance_id'),
    ];

    $form['balance_group']['total_balance_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Total Balance Label.'),
      '#description' => $this->t('The label for the total balance'),
      '#default_value' => $this->get('total_balance_label'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['balance_group']['balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Balance Mapping'),
      '#description' => $this->t('Provide a product mapping that will show up below the username'),
      '#default_value' => $this->get('balance_mapping'),
      '#translatable' => TRUE,
    ];

    $form['balance_group']['balance_label_override'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lottery Balance Label Override in Tooltip'),
      '#description' => $this->t('Provide a label to override LD and Lottery label specific for SC and RMB currency'),
      '#default_value' => $this->get('balance_label_override'),
      '#translatable' => TRUE,
    ];

    $form['balance_group']['balance_error_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Balance Error Message.'),
      '#description' => $this->t('Balance Error Message.'),
      '#default_value' => $this->get('balance_error_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['balance_group']['balance_error_text_product'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Balance Error Message'),
      '#description' => $this->t('Error message for the per product balance'),
      '#default_value' => $this->get('balance_error_text_product'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['balance_group']['balance_label_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Balances Label Mapping'),
      '#description' => $this->t('Labels and ordering for the balance breakdown'),
      '#default_value' => $this->get('balance_label_mapping'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#default_value' => $this->get('currency_balance_mapping'),
      '#translatable' => TRUE,
    ];

    $form['balance_group']['excluded_balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Excluded Balance Mapping'),
      '#description' => $this->t('Define product IDs one per line'),
      '#default_value' => $this->get('excluded_balance_mapping'),
      '#translatable' => TRUE,
    ];

    $form['balance_group']['currency_label_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Currency Label Mapping on Header Total Balance'),
      '#description' => $this->t("Define a mapping of cashier currency Label to site specific currency label.
        This will appear on header total balance
        <br><br>
        Pattern:
        <br>
        {Cashier Currency Label}|{Site Specific Currency Label Alter}
        <br><br>
        Example:
        <br>
        KSH|KSh

      "),
      '#default_value' => $this->get('currency_label_mapping'),
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionNewtag(array &$form) {
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
      '#default_value' => $this->get('product_menu_new_tag'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionWelcome(array &$form) {
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
        '#default_value' => $this->get('welcome_text'),
        '#required' => TRUE,
        '#translatable' => TRUE,
      ];

      $form['welcome_text_group']['profile_link'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Profile Link'),
        '#description' => $this->t('Profile Link'),
        '#default_value' => $this->get('profile_link'),
        '#rows' => 1,
        '#required' => TRUE,
        '#translatable' => TRUE,
      ];
  }

  /**
   *
   */
  private function sectionAnnouncement(array &$form) {
    $default_news_announcement = $this->get('news_announcement_content');
    $default_critical_announcement = $this->get('critical_announcement_content');

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
      '#default_value' => $this->get('critical_announcement'),
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
    ];

    $form['announcement_group']['news_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('News'),
    ];

    $form['announcement_group']['news_issue']['news_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable news announcements',
      '#description' => $this->t('Show/hide news announcement. Default value is "Enabled".'),
      '#default_value' => $this->get('news_announcement'),
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
    ];
  }

  /**
   * More menu section translation confu
   *
   */
  private function moreMenuTranslation(array &$form)
  {
    $form['more_menu_translation'] = [
      '#type' => 'details',
      '#title' => $this->t('More Menu'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    //more feature flag checkbox
    $form['more_menu_translation']['use_more_translation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use more menu translation'),
      '#description' => $this->t('Enable/Disable more menu translation.'),
      '#default_value' => $this->get('use_more_translation'),
      '#translatable' => TRUE,
    ];

    $form['more_menu_translation']['more'] = [
      '#type' => 'textfield',
      '#title' => $this->t('More menu translation'),
      '#description' => $this->t('More menu translation'),
      '#default_value' => $this->get('more'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionOther(array &$form) {
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
      '#default_value' => $this->get('lobby_page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['header_other_group']['promotion_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Page Title.'),
      '#description' => $this->t('Promotion Page Title.'),
      '#default_value' => $this->get('promotion_page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['header_other_group']['links_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Quicklinks Label'),
      '#description' => $this->t('Quicklinks Label'),
      '#default_value' => $this->get('links_title'),
      '#required' => true,
      '#translatable' => true,
    ];
  }
}
