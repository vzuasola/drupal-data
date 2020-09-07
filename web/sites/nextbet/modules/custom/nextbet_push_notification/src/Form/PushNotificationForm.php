<?php

namespace Drupal\nextbet_push_notification\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Push Notification configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_push_notification",
 *   route = {
 *     "title" = "Product Push Notification Configuration",
 *     "path" = "/admin/config/nextbet/config/push_notification",
 *   },
 *   menu = {
 *     "title" = "Product Push Notification Configuration",
 *     "description" = "Provides product configuration for push notification components",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class PushNotificationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nextbet_push_notification.push_notification_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['push_notification_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Push Notification Configuration Product Override'),
    ];

    $products = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('product');

    foreach ($products as $key => $value) {
      if ($value->name != 'entry') {
        $this->getFieldsTab($form[$key], $value->name);
      }
    }

    return $form;
  }

  private function getFieldsTab(&$form, $value) {
    $form = [
      '#type' => 'details',
      '#title' => ucfirst($this->t($value)),
      '#collapsible' => TRUE,
      '#group' => 'push_notification_settings_tab'
    ];

    $this->productSettings($form, $value);

    return $form;
  }

  private function productSettings(&$form, $value) {
    // Product Settings
    $form['products_settings'][$value . '_product_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Products'),
      '#default_value' => $this->get($value . '_product_list'),
      '#description' => $this->t('Enter Product per line.'),
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get($value . '_product_list')));

    foreach ($texts as $text) {
      $text_key = strtolower($text);
      $text_key = str_replace(' ', '', $text_key);

      if (!empty($text_key)) {
        $form['products_settings'][$text_key] = [
          '#type' => 'details',
          '#title' => $this->t($text),
        ];

        $form['products_settings'][$text_key][$value . '_product_label_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Label'),
          '#default_value' => $this->get($value . '_product_label_' . $text_key),
          '#description' => $this->t('Product Label.'),
          '#translatable' => TRUE,
        ];

        $form['products_settings'][$text_key][$value . '_product_type_id_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Type ID'),
          '#default_value' => $this->get($value . '_product_type_id_' . $text_key),
          '#description' => $this->t('Assigned ProductTypeId.'),
        ];

        $form['products_settings'][$text_key][$value . '_product_icon_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Product Icon'),
          '#default_value' => $this->get($value . '_product_icon_' . $text_key),
          '#description' => $this->t('Icon template to use. Icon templates defined on site level.'),
        ];

        $form['products_settings'][$text_key][$value . '_product_exclude_' . $text_key] = [
          '#type' => 'checkbox',
          '#title' => $this->t('Exclude from filtering'),
          '#default_value' => $this->get($value . '_product_exclude_' . $text_key),
          '#description' => $this->t($text . ' messages will not be included on the list.'),
        ];

        $form['products_settings'][$text_key][$value . '_product_exclude_dismiss_' . $text_key] = [
          '#type' => 'checkbox',
          '#title' => $this->t('Exclude from dismiss all'),
          '#default_value' => $this->get($value . '_product_exclude_dismiss_' . $text_key),
          '#description' => $this->t($text . ' messages will not be included on the dismiss all.'),
        ];
      }
    }
  }
}
