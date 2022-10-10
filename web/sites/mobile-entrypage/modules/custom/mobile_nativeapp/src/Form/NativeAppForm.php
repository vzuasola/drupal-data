<?php

namespace Drupal\mobile_nativeapp\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_nativeapp",
 *   route = {
 *     "title" = "Native App Configuration",
 *     "path" = "/admin/config/mobile/nativeapp/configuration",
 *   },
 *   menu = {
 *     "title" = "Native App Configuration",
 *     "description" = "Provides configuration for Native app",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class NativeAppForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_nativeapp.nativeapp_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['integration'] = [
      '#type' => 'details',
      '#title' => $this->t('Integration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['integration']['nativeapp_restricted'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Restricted Countries'),
      '#default_value' => $this->get('nativeapp_restricted'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
