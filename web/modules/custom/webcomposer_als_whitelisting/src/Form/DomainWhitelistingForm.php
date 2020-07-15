<?php

namespace Drupal\webcomposer_als_whitelisting\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "als_whitelisting_config_form",
 *   route = {
 *     "title" = "ALS Whitelisting Configuration",
 *     "path" = "/admin/config/mobile/als-whitelisting/configuration",
 *   },
 *   menu = {
 *     "title" = "ALS Whitelisting Configuration",
 *     "description" = "Provides configuration for ALS Whitelisting",
 *     "parent" = "mobile_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class DomainWhitelistingForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.als_whitelisting_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['enable_localhost'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Localhost'),
      '#default_value' => $this->get('enable_localhost'),
      '#description' => $this->t('This will allow developers to connect when checked'),
      '#translatable' => FALSE,
    ];

    $form['whitelisted_domain'] = [
      '#type' => 'textarea',
      '#rows' => 10,
      '#title' => $this->t('Whitelisted Domains'),
      '#default_value' => $this->get('whitelisted_domain'),
      '#description' => $this->t("Kindly add the domain per line
        <br>
        <small><strong>Example:</strong>
        <br>example.domain1.com
        <br>example.domain2.com</small>"),
      '#translatable' => FALSE,
    ];

    return $form;
  }

}
