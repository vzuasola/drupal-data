<?php

namespace Drupal\webcomposer_site_page_not_found\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Page Not Found configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_site_page_not_found",
 *   route = {
 *     "title" = "Site Page Not Found Configuration",
 *     "path" = "/admin/config/webcomposer/config/page_not_found",
 *   },
 *   menu = {
 *     "title" = "Site Page Not Found Configuration",
 *     "description" = "Provides configuration for site Page Not Found",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class WebComposerPageNotFoundConfigurationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.webcomposer_site_page_not_found'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['page_not_found_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Site Page Not Found Configuration'),
    ];

    $form['products_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Products Settings'),
      '#group' => 'page_not_found_settings_tab',
    ];

    // Product Settings
    $form['products_settings']['page_not_found_product_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Products'),
      '#default_value' => $this->get('page_not_found_product_list'),
      '#description' => $this->t('Enter Product per line.'),
      '#translatable' => TRUE,
    ];

    $texts = array_map('trim', explode(PHP_EOL, $this->get('page_not_found_product_list')));

    foreach ($texts as $text) {
      $text_key = strtolower($text);
      $text_key = str_replace(' ', '', $text_key);

      if (!empty($text_key)) {
        $form['products_settings'][$text_key] = [
          '#type' => 'details',
          '#title' => $this->t($text),
        ];

        $form['products_settings'][$text_key]['page_not_found_title_' . $text_key] = [
          '#type' => 'textfield',
          '#title' => $this->t('Page Not Found Title'),
          '#default_value' => $this->get('page_not_found_title_' . $text_key),
          '#description' => $this->t('Page Not Found Title.'),
          '#translatable' => TRUE,
        ];

        $content = $this->get('page_not_found_content_' . $text_key);
        $form['products_settings'][$text_key]['page_not_found_content_' . $text_key] = [
          '#type' => 'text_format',
          '#title' => $this->t('Page Not Found Content'),
          '#default_value' => $content['value'],
          '#format' => $content['format'],
          '#description' => $this->t('Page Not Found Content.'),
          '#translatable' => TRUE,
        ];
      }
    }
    return $form;
  }
}
