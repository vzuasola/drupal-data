<?php

namespace Drupal\webcomposer_catchpoint\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "catchpoint_config_form",
 *   route = {
 *     "title" = "Catchpoint Configuration",
 *     "path" = "/admin/config/webcomposer/catchpoint",
 *   },
 *   menu = {
 *     "title" = "Catchpoint Configuration",
 *     "description" = "Provides configuration for Catchpoint",
 *     "parent" = "mobile_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class CatchpointConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.catchpoint_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['app_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('RUM Application ID'),
      '#default_value' => $this->get('app_id'),
      '#description' => $this->t('This will make Catchpoint tracking script available'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
