<?php

namespace Drupal\webcomposer_cdn\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "cdn_config_form",
 *   route = {
 *     "title" = "CDN Configuration",
 *     "path" = "/admin/config/webcomposer/cdn/settings",
 *   },
 *   menu = {
 *     "title" = "CDN configuration",
 *     "description" = "Provides configuration for CDN",
 *     "parent" = "webcomposer_cdn.list",
 *     "weight" = 30
 *   },
 * )
 */
class CDNConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.cdn_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['enable_cdn'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable CDN'),
      '#default_value' => $this->get('enable_cdn'),
      '#description' => $this->t('This will enable CDN functionality if checked'),
    ];
    $form['cdn_domain_configuration'] = [
      '#type' => 'textarea',
      '#rows' => 20,
      '#title' => $this->t('CDN Domain Configuration'),
      '#default_value' => $this->get('cdn_domain_configuration'),
      '#description' => $this->t("Add the CDN domain mapping. Mapping should consist of
        country code to CDN domain.
        <br>
        Example <strong>PH|example.cdn.com</strong>"),
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
