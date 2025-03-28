<?php

namespace Drupal\webcomposer_download_page\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Download page form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "download_page",
 *   route = {
 *     "title" = "Download Page Configuration Form",
 *     "path" = "/admin/config/webcomposer_download_page/settings",
 *   },
 *   menu = {
 *     "title" = "Download Page Configuration",
 *     "description" = "Provides configuration for Download Page",
 *     "parent" = "webcomposer_download_page.list",
 *     "weight" = -5
 *   },
 * )
 */
class WebcomposerDownloadPageConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_download_page.download_page'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $form['client_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Client Label'),
      '#default_value' => $this->get('client_label'),
      '#translatable' => TRUE,
    ];

    $form['mobile_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Label'),
      '#default_value' => $this->get('mobile_label'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
