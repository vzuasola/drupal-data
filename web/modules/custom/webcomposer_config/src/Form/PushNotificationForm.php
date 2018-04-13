<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Push Notification configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_pushnx",
 *   route = {
 *     "title" = "Push Notification Configuration",
 *     "path" = "/admin/config/webcomposer/config/pushnx",
 *   },
 *   menu = {
 *     "title" = "Push Notification Configuration",
 *     "description" = "Provides configuration for push notification",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class PushNotificationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.pushnx_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['pushnx_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Push Notification Configuration'),
    ];

    // Vertical Tabs.
    $form['connection_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Connection Settings'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['translated_texts_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Translated Contents'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['dismiss_notifications_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Dismiss Notifications'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['expiry_error_message_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Expiry Error Message'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['date_format_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Date Format'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['exclude_page_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Exclude Pages'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['debug_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Debug Settings'),
      '#group' => 'pushnx_settings_tab',
    ];

    // Connection Settings.
    $form['connection_settings']['enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Push Notification'),
      '#default_value' => $this->get('enable'),
      '#description' => $this->t('Enable/Disable Push Notification.'),
    ];

    $form['connection_settings']['disableBonusAward'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Bonus Was Awarded'),
      '#default_value' => $this->get('disableBonusAward'),
      '#description' => $this->t('Hide Bonus Was Awarded notification.'),
    ];

    $form['connection_settings']['domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Domain'),
      '#default_value' => $this->get('domain'),
      '#description' => $this->t('Override default Push server domain.'),
    ];

    $form['connection_settings']['producttype_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Type Id'),
      '#default_value' => $this->get('producttype_id'),
      '#description' => $this->t('Set Product Type Id to receive product notification.
        Player will receive Manual Notification by default.'
      ),
    ];

    $form['connection_settings']['retry_count'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Retry Count'),
      '#default_value' => $this->get('retry_count'),
      '#description' => $this->t('Number of retry sent to reply url on failure.'),
    ];

    $form['connection_settings']['delay_count'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Delay Count'),
      '#default_value' => $this->get('delay_count'),
      '#description' => $this->t('Milisecond of delay to retry.'),
    ];

    $form['connection_settings']['expiry_delay_count'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Expiry Delay Count'),
      '#default_value' => $this->get('expiry_delay_count'),
      '#description' => $this->t('Milisecond of delay to show the expiry message.'),
    ];

    // Debug Settings.
    $form['debug_settings']['debug_logging'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Chronicle Logging'),
      '#default_value' => $this->get('debug_logging'),
      '#description' => $this->t('Chronicle Logging.'),
    ];

    $form['debug_settings']['debug_display_expirydate'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display Expiry Date'),
      '#default_value' => $this->get('debug_display_expirydate'),
      '#description' => $this->t('Show Expiry Date on Messages.'),
    ];

    $form['debug_settings']['debug_display_all'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Filter Expired Messages'),
      '#default_value' => $this->get('debug_display_all'),
      '#description' => $this->t('Enable filtering of Expired Messages.'),
    ];

    // Exclude Pages.
    $form['exclude_page_settings']['exclude_pages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Exclude Pages'),
      '#default_value' => $this->get('exclude_pages'),
      '#description' => $this->t('Enter the list of path to be excluded. If this
        fields is left empty, all path can show notification. Enter one path per line.'
      ),
    ];

    // Translate Texts.
    $form['translated_texts_settings']['translated_texts'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Translated Contents'),
      '#default_value' => $this->get('translated_texts'),
      '#description' => $this->t('Enter the list of text to be translated. Enter one text per line.'),
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get('translated_texts')));

    foreach ($texts as $text) {
      $text_key = strtolower($text);

      $form['translated_texts_settings']['text_' . $text_key] = [
        '#type' => 'textarea',
        '#title' => $text,
        '#default_value' => $this->get('text_' . $text_key, ''),
        '#description' => 'Format: ICORE LANGUAGE|TRANSLATION',
      ];
    }

    // Dismiss Notifications.
    $form['dismiss_notifications_settings']['dismiss_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dismiss Button'),
      '#default_value' => $this->get('dismiss_button_label'),
      '#description' => $this->t('Dismiss button or link text.'),
      '#translatable' => TRUE,
    ];

    $dismiss = $this->get('dismiss_content');

    $form['dismiss_notifications_settings']['dismiss_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Dismiss Message'),
      '#default_value' => $dismiss['value'],
      '#format' => $dismiss['format'],
      '#translatable' => TRUE,
    ];

    $form['dismiss_notifications_settings']['dismiss_yes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Yes'),
      '#default_value' => $this->get('dismiss_yes'),
      '#description' => $this->t('Yes button label.'),
      '#translatable' => TRUE,
    ];

    $form['dismiss_notifications_settings']['dismiss_no'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No'),
      '#default_value' => $this->get('dismiss_no'),
      '#description' => $this->t('No button label.'),
      '#translatable' => TRUE,
    ];

    $form['expiry_error_message_settings']['expiry_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Expiry Error Message'),
      '#default_value' => $this->get('expiry_error_message'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    ];

    $form['date_format_settings']['date_format'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Date Format'),
      '#default_value' => $this->get('date_format'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    ];

    $form['date_format_settings']['date_offset'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Date Offset'),
      '#default_value' => $this->get('date_offset'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'enable',
      'producttype_id',
      'domain',
      'retry_count',
      'delay_count',
      'expiry_delay_count',
      'exclude_pages',
      'translated_texts',
      'dismiss_button_label',
      'dismiss_content',
      'dismiss_yes',
      'dismiss_no',
      'expiry_error_message',
      'date_format',
      'date_offset',
      'login_selector',
      'debug_logging',
      'debug_display_all',
      'debug_display_expirydate',
      'disableBonusAward',
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get('translated_texts')));

    foreach ($texts as $text) {
      $keys[] = 'text_' . strtolower($text);
    }

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}
