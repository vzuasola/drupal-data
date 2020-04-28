<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_general_config_form",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/msw/msw_general_configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides General configuration for MSW",
 *     "parent" = "msw_config.list",
 *     "weight" = 11
 *   },
 * )
 */

class MSWGeneralConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['msw_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
        '#type' => 'vertical_tabs',
        '#title' => t('General Configuration'),
    ];

    $this->registrationConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function registrationConfig(array &$form) {
    $form['registration_setting'] = [
      '#type' => 'details',
      '#title' => t('Registration Configuration'),
      '#group' => 'advanced',
    ];

    $form['registration_setting']['registration'] = [
      '#type' => 'details',
      '#title' => $this->t('Slipstream'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['registration_setting']['registration']['registration_step_two_target'] = [
      '#type' => 'select',
      '#title' => $this->t('Step 2'),
      '#default_value' => $this->get("registration_step_two_target") ?: '_self',
      '#translatable' => TRUE,
      '#options' => [
        '_blank' => $this->t('New Window'),
        '_self' => $this->t('Same Window'),
        'window' => $this->t('Popup Window'),
      ],
    ];

    $form['registration_setting']['registration']['registration_step_two_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Step 2 URL'),
      '#default_value' => $this->get('registration_step_two_url'),
      '#translatable' => TRUE,
    ];

    $form['registration_setting']['registration']['registration_keep_alive_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Keep Alive Endpoint'),
      '#default_value' => $this->get('registration_keep_alive_url'),
      '#translatable' => TRUE,
    ];
  }

}
