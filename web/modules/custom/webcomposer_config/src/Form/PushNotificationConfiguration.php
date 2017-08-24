<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class PushNotificationConfiguration extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['webcomposer_config.pushnx_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'pushnx_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('webcomposer_config.pushnx_configuration');

    $form['pushnx_settings_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    // Vertical Tabs
    $form['connection_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Connection Settings'),
      '#group' => 'pushnx_settings_tab',
    );
    $form['translated_texts_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Translated Texts'),
      '#group' => 'pushnx_settings_tab',
    );
    $form['expiry_error_message_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Expiry Error Message'),
      '#group' => 'pushnx_settings_tab',
    );
    $form['date_format_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Date Format'),
      '#group' => 'pushnx_settings_tab',
    );
    $form['exclude_page_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Exclude Pages'),
      '#group' => 'pushnx_settings_tab',
    );
    $form['debug_settings'] = array(
      '#type' => 'details',
      '#title' => $this->t('Debug Settings'),
      '#group' => 'pushnx_settings_tab',
      );
    // Connection Settings
    $form['connection_settings']['enable'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Push Notification'),
      '#default_value' => $config->get('enable'),
      '#description' => $this->t('Enable/Disable Push Notification.'),
    );
    $form['connection_settings']['domain'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Domain'),
      '#default_value' => $config->get('domain'),
      '#description' => $this->t('Override default Push server domain.'),
    );
    $form['connection_settings']['producttype_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Product Type Id'),
      '#default_value' => $config->get('producttype_id'),
      '#description' => $this->t('Set Product Type Id to receive product notification. Player will receive Manual Notification by default.'),
    );
    $form['connection_settings']['retry_count'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Retry Count'),
      '#default_value' => $config->get('retry_count'),
      '#description' => $this->t('Number of retry sent to reply url on failure.'),
    );
    $form['connection_settings']['delay_count'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Delay Count'),
      '#default_value' => $config->get('delay_count'),
      '#description' => $this->t('Milisecond of delay to retry.'),
    );
    $form['connection_settings']['expiry_delay_count'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Expiry Delay Count'),
      '#default_value' => $config->get('expiry_delay_count'),
      '#description' => $this->t('Milisecond of delay to show the expiry message.'),
    );
    // Debug Settings
    $form['debug_settings']['debug_logging'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Chronicle Logging'),
      '#default_value' => $config->get('debug_logging'),
      '#description' => $this->t('Chronicle Logging.'),
    );
    $form['debug_settings']['debug_display_expirydate'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Display Expiry Date'),
      '#default_value' => $config->get('debug_display_expirydate'),
      '#description' => $this->t('Show Expiry Date on Messages.'),
    );
    $form['debug_settings']['debug_display_all'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Filter Expired Messages'),
      '#default_value' => $config->get('debug_display_all'),
      '#description' => $this->t('Enable filtering of Expired Messages.'),
    );
    // Exclude Pages
    $form['exclude_page_settings']['exclude_pages'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Exclude Pages'),
      '#default_value' => $config->get('exclude_pages'),
      '#description' => $this->t('Enter the list of path to be excluded. If this fields is left empty, all path can show notification. Enter one path per line.'),
    );
    // Translate Texts
    $form['translated_texts_settings']['translated_texts'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Translated Texts'),
      '#default_value' => $config->get('translated_texts'),
      '#description' => $this->t('Enter the list of text to be translated. Enter one text per line.'),
    );

    $texts = array_map('trim', explode(PHP_EOL, $config->get('translated_texts')));
    foreach ($texts as $text) {
      $text_key = strtolower($text);

      $form['translated_texts_settings']['text_'.$text_key] = array(
        '#type' => 'textarea',
        '#title' => $text,
        '#default_value' => $config->get('text_'.$text_key, ''),
        '#description' => 'Format: ICORE LANGUAGE|TRANSLATION',
      );
    }

    $form['expiry_error_message_settings']['expiry_error_message'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Expiry Error Message'),
      '#default_value' => $config->get('expiry_error_message'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    );
    $form['date_format_settings']['date_format'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Date Format'),
      '#default_value' => $config->get('date_format'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    );
    $form['date_format_settings']['date_offset'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Date Offset'),
      '#default_value' => $config->get('date_offset'),
      '#description' => $this->t('Format: ICORE LANGUAGE|TRANSLATION'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $keys = array(
      'enable',
      'producttype_id',
      'domain',
      'retry_count',
      'delay_count',
      'expiry_delay_count',
      'exclude_pages',
      'translated_texts',
      'expiry_error_message',
      'date_format',
      'date_offset',
      'login_selector',
      'debug_logging',
      'debug_display_all',
      'debug_display_expirydate'
    );

    $config = $this->config('webcomposer_config.pushnx_configuration');
    $texts = array_map('trim', explode(PHP_EOL, $config->get('translated_texts')));
    foreach ($texts as $text) {
        $keys[] = 'text_' . strtolower($text);
    }

    foreach ($keys as $key) {
        $this->config('webcomposer_config.pushnx_configuration')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
