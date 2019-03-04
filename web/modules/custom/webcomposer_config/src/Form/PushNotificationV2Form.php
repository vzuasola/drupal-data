<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Push Notification configuration V2 plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_pushnx_v2",
 *   route = {
 *     "title" = "Push Notification V2 Configuration",
 *     "path" = "/admin/config/webcomposer/config/pushnxv2",
 *   },
 *   menu = {
 *     "title" = "Push Notification V2 Configuration",
 *     "description" = "Provides V2 configuration for push notification",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class PushNotificationV2Form extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.pushnx_configuration_v2'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['pushnx_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Push Notification Configuration V2'),
    ];

    // Vertical Tabs.
    $form['connection_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('General Settings'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['products_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Products Settings'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['content_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Contents'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['layout_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Layout'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['cta_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('CTA Buttons'),
      '#group' => 'pushnx_settings_tab',
    ];

    $form['dismiss_notifications_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Dismiss Notifications'),
      '#group' => 'pushnx_settings_tab',
      '#disabled' => false,
    ];

    $form['domain_map_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Domains'),
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

    $form['connection_settings']['debug_display_all'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Filter Expired Messages'),
      '#default_value' => $this->get('debug_display_all'),
      '#description' => $this->t('Enable filtering of Expired Messages.'),
    ];

    $form['connection_settings']['domain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Domain'),
      '#default_value' => $this->get('domain'),
      '#description' => $this->t('Override default Push server domain.'),
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

    // Product Settings
    $form['products_settings']['product_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Products'),
      '#default_value' => $this->get('product_list'),
      '#description' => $this->t('Enter Product per line.'),
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get('product_list')));

    foreach ($texts as $text) {
      $text_key = strtolower($text);
      $text_key = str_replace(' ', '', $text_key);

      if (!empty($text_key)) {
        $form['products_settings'][$text_key] = [
          '#type' => 'details',
          '#title' => $this->t($text),
        ];

        $form['products_settings'][$text_key]['product_label_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Label'),
          '#default_value' => $this->get('product_label_' . $text_key),
          '#description' => $this->t('Product Label.'),
          '#translatable' => TRUE,
        ];

        $form['products_settings'][$text_key]['product_type_id_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Type ID'),
          '#default_value' => $this->get('product_type_id_' . $text_key),
          '#description' => $this->t('Assigned ProductTypeId.'),
        ];

        $form['products_settings'][$text_key]['product_icon_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Icon'),
          '#default_value' => $this->get('product_icon_' . $text_key),
          '#description' => $this->t('Icon template to use. Icon templates defined on site level.'),
        ];

        $form['products_settings'][$text_key]['product_exclude_' . $text_key] = [
          '#type' => 'checkbox',
          '#title' => $this->t('Exclude from filtering'),
          '#default_value' => $this->get('product_exclude_' . $text_key),
          '#description' => $this->t($text . ' messages will not be included on the list.'),
        ];

        $form['products_settings'][$text_key]['product_exclude_dismiss_' . $text_key] = [
          '#type' => 'checkbox',
          '#title' => $this->t('Exclude from dismiss all'),
          '#default_value' => $this->get('product_exclude_dismiss_' . $text_key),
          '#description' => $this->t($text . ' messages will not be included on the dismiss all.'),
        ];
      }
    }

    // Contents Settings.
    $form['content_settings']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#description' => $this->t('Layout Title'),
      '#translatable' => TRUE,
    ];

    $form['content_settings']['empty'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Empty message'),
      '#default_value' => $this->get('empty'),
      '#description' => $this->t('Empty message'),
      '#translatable' => TRUE,
    ];

    $form['content_settings']['expired_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Expiry error message'),
      '#default_value' => $this->get('expired_message'),
      '#description' => $this->t('Expiry error message'),
      '#translatable' => TRUE,
    ];

    $form['content_settings']['copied'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copy to clipboard message'),
      '#default_value' => $this->get('copied'),
      '#description' => $this->t('Copy to clipboard message'),
      '#translatable' => TRUE,
    ];

    $form['content_settings']['date_format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date Format'),
      '#default_value' => $this->get('date_format'),
      '#description' => $this->t('Date Format'),
      '#translatable' => TRUE,
    ];

    $form['content_settings']['date_offset'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date Offset'),
      '#default_value' => $this->get('date_offset'),
      '#description' => $this->t('Date Offset'),
      '#translatable' => TRUE,
    ];

    // CTA Buttons Settings.
    $form['cta_settings']['cta_button_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('CTA Buttons'),
      '#default_value' => $this->get('cta_button_list'),
      '#description' => $this->t('Enter CTA Buttons per line.'),
    ];

    $buttons = array_map('trim', explode(PHP_EOL, $this->get('cta_button_list')));

    foreach ($buttons as $button) {
      $button_key = strtolower($button);
      $button_key = str_replace(' ', '', $button_key);

      if (!empty($button_key)) {
        $form['cta_settings'][$button_key] = [
          '#type' => 'details',
          '#title' => $this->t($button),
        ];

        $form['cta_settings'][$button_key]['cta_label_' . $button_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Button Label'),
          '#default_value' => $this->get('cta_label_' . $button_key),
          '#description' => $this->t('Button Label.'),
          '#translatable' => TRUE,
        ];

        $form['cta_settings'][$button_key]['cta_actions_' . $button_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Action'),
          '#default_value' => $this->get('cta_actions_' . $button_key),
          '#maxlength' => 2048,
          '#description' => $this->t('Bind action that will be triggered before message acknowledge.'),
        ];
      }
    }

    $list_items[] = 'copy::id';
    $list_items[] = 'redirect::domaintoken';
    $list_items[] = 'popup::domaintoken';
    $list_items[] = 'newtab::domaintoken';

    $form['cta_settings']['cta_button_helper'] = [
      '#prefix' => '<div>',
      '#markup' => 'Available action that can be bind on CTA.',
      '#suffix' => '</div>',
    ];

    $form['cta_settings']['cta_button_legends'] = [
      '#prefix' => '<ul><li>',
      '#markup' => implode('</li><li>', $list_items),
      '#suffix' => '</li></ul>',
    ];

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

    // Domain Mapping.
    $form['domain_map_settings']['domains'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mapping'),
      '#default_value' => $this->get('domains'),
      '#description' => $this->t('Enter the list of allowed domain on push notification. Format key|domain'),
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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'enable',
      'disableBonusAward',
      'debug_display_all',
      'domain',
      'retry_count',
      'delay_count',
      'expiry_delay_count',
      'product_list',
      'title',
      'empty',
      'expired_message',
      'copied',
      'date_format',
      'date_offset',
      'cta_button_list',
      'dismiss_button_label',
      'dismiss_content',
      'dismiss_yes',
      'dismiss_no',
      'domains',
      'exclude_pages',
      'debug_logging',
      'debug_display_expirydate',
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get('product_list')));
    $texts = str_replace(' ', '', $texts);

    foreach ($texts as $text) {
      $keys[] = 'product_label_' . strtolower($text);
      $keys[] = 'product_type_id_' . strtolower($text);
      $keys[] = 'product_icon_' . strtolower($text);
      $keys[] = 'product_exclude_' . strtolower($text);
      $keys[] = 'product_exclude_dismiss_' . strtolower($text);
    }

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $buttons = array_map('trim', explode(PHP_EOL, $this->get('cta_button_list')));
    $buttons = str_replace(' ', '', $buttons);

    foreach ($buttons as $button) {
      $keys[] = 'cta_label_' . strtolower($button);
      $keys[] = 'cta_actions_' . strtolower($button);
    }

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}
