<?php

namespace Drupal\webcomposer_site_maintenance\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Push Notification configuration V2 plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_site_maintenance",
 *   route = {
 *     "title" = "Site Maintenance Configuration",
 *     "path" = "/admin/config/webcomposer/config/maintenance",
 *   },
 *   menu = {
 *     "title" = "Site Maintenance Configuration",
 *     "description" = "Provides configuration for site maintenance",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class WebComposerSiteMaintenanceConfigurationForm extends FormBase {

    const MAINTENANCE_TIMEZONE = 'UTC';

    const MAINTENANCE_TIME_FORMAT = 'm/d/Y H:i:s';

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.webcomposer_site_maintenance'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['maintenance_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Site Maintenance Configuration'),
    ];

    $form['products_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Products Settings'),
      '#group' => 'maintenance_settings_tab',
    ];

    // Product Settings
    $form['products_settings']['product_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Products'),
      '#default_value' => $this->get('product_list'),
      '#description' => $this->t('Enter Product per line.'),
      '#translatable' => TRUE,
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

        $form['products_settings'][$text_key]['maintenance_title_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Maintenance Page Title'),
          '#default_value' => $this->get('maintenance_title_' . $text_key),
          '#description' => $this->t('Maintenance Page Title.'),
          '#translatable' => TRUE,
        ];

        $content = $this->get('maintenance_content_' . $text_key);
        $form['products_settings'][$text_key]['maintenance_content_' . $text_key] = [
          '#type' => 'text_format',
          '#title' => $this->t('Maintenance Page Content'),
          '#default_value' => $content['value'],
          '#format' => $content['format'],
          '#description' => $this->t('Maintenance Page Content.'),
          '#translatable' => TRUE,
        ];

        $form['products_settings'][$text_key]['maintenance_publish_date_' . $text_key] = [
          '#type' => 'datetime',
          '#title' => $this->t('Publish Date'),
          '#format' => self::MAINTENANCE_TIME_FORMAT,
          '#date_timezone' => drupal_get_user_timezone(),
          '#description' => $this->t('Publishing date for the maintenance page.'),
          '#default_value' => $this->get('maintenance_publish_date_' . $text_key,
            ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
          '#translatable' => TRUE,
        ];

        $form['products_settings'][$text_key]['maintenance_unpublish_date_' . $text_key] = [
          '#type' => 'datetime',
          '#title' => $this->t('Unpublish Date'),
          '#format' => self::MAINTENANCE_TIME_FORMAT,
          '#date_timezone' => drupal_get_user_timezone(),
          '#description' => $this->t('unpublishing date for the maintenance page.'),
          '#default_value' => $this->get('maintenance_unpublish_date_' . $text_key,
            ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
          '#translatable' => TRUE,
        ];
      }
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $texts = array_map('trim', explode(PHP_EOL, $this->get('product_list')));

    foreach ($texts as $text) {
      $text_key = strtolower($text);
      $text_key = str_replace(' ', '', $text_key);

      $publishDate = $form_state->getValue('maintenance_publish_date_' . $text_key)
      ? $form_state->getValue('maintenance_publish_date_' . $text_key)->getTimestamp()
      : '';
    $unpublishDate = $form_state->getValue('maintenance_unpublish_date_' . $text_key)
      ? $form_state->getValue('maintenance_unpublish_date_' . $text_key)->getTimestamp()
      : '';

      if ($unpublishDate && $unpublishDate < $publishDate) {
        $form_state->setErrorByName('maintenance_unpublish_date_' . $text_key,
         t('Unpublish date should be greater than the publish date.'));
      }
    }
  }
}
