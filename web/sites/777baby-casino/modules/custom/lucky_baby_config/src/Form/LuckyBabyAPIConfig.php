<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_api_config",
 *   route = {
 *     "title" = "Lucky Baby API Configuration",
 *     "path" = "/admin/config/lucky_baby/api_configuration",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby API Configuration",
 *     "description" = "Provides Lucky Baby API configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyAPIConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.api_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['whitelist_urls'] = [
      '#type' => 'textarea',
      '#title' => $this->t('URLs'),
      '#default_value' => $this->get('whitelist_urls'),
      '#description' => $this->t('Define urls that should be allowed for Lucky Baby API access. Provide one url per line.
                        <br>
                        Example:
                        <br>
                        https://www.site.com'),
      '#translatable' => FALSE,
    ];

    return $form;
  }
}
