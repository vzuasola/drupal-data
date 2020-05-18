<?php

namespace Drupal\msw_urls\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW url configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_urls",
 *   route = {
 *     "title" = "Whitelist Url Configuration",
 *     "path" = "/admin/config/msw/urls/configuration",
 *   },
 *   menu = {
 *     "title" = "Whitelist Url Configuration",
 *     "description" = "Provides configuration for url whitelisting",
 *     "parent" = "msw_config.list",
 *   },
 * )
 */
class UrlsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['msw_urls.urls_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['whitelist_urls'] = [
      '#type' => 'textarea',
      '#title' => $this->t('URLs'),
      '#default_value' => $this->get('whitelist_urls'),
      '#description' => $this->t('Define urls that should be allowed for MSW access. Provide one url per line.
                        <br>
                        Example:
                        <br>
                        https://www.site.com'),
      '#translatable' => FALSE,
    ];

    return $form;
  }
}
