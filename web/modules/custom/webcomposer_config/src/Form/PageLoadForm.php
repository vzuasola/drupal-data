<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Page Load configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_browser",
 *   route = {
 *     "title" = "Page Load Configuration",
 *     "path" = "/admin/config/webcomposer/config/pageload",
 *   },
 *   menu = {
 *     "title" = "Page Load Configuration",
 *     "description" = "Provides configuration for page load optimizations",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class PageLoadForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.pageload_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Page Load configuration'),
    ];

    $form['preconnect'] = [
      '#type' => 'details',
      '#title' => $this->t('Precoonect hosts'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['preconnect']['preconnect_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Hosts to preconnect'),
      '#description' => $this->t('A list of base URLs to which we should preconnect. (one URL per line)'),
      '#default_value' => $this->get('preconnect_list'),
      '#translatable' => false,
    ];

    $form['preload'] = [
      '#type' => 'details',
      '#title' => $this->t('Preload assets'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['preload']['preload_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Assets to preload'),
      '#description' => $this->t('A list of assets to preload. One asset per line. The format should be the following: "{assetType}|{url}|{fetchpriority}|{fontType}" . Asset type can be "script", "style" or "font" . The URL can be absolute or relative. A relative URL should start with a / . IF you dont want to modify the fetchpriority property, use "default" as a value. Font type is optional and it is only used for font assets'),
      '#default_value' => $this->get('preload_list'),
      '#translatable' => false,
    ];

    return $form;
  }
}
