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
    $this->onlineRegisterConfig($form);

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

    $form['registration_setting']['registration']['registation_icore_error_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Icore Error Mapping'),
      '#default_value' => $this->get('registation_icore_error_mapping'),
      '#description' => $this->t('Icore Registration Response Code Mapping Message. Format example: {StatusCode}|{Message}'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['registration_setting']['registration']['registration_jpay_integration'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Jpay Integration'),
      '#default_value' => $this->get('registration_jpay_integration'),
      '#description' => $this->t('JPay API url for registration account creation.'),
      '#required' => TRUE,
    ];

    $form['registration_setting']['registration']['registration_site_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site ID'),
      '#default_value' => $this->get('registration_site_id'),
      '#description' => $this->t('Site ID of MSW.'),
      '#required' => TRUE,
    ];

    $form['registration_setting']['registration']['registration_portal_id_slipstream'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Portal ID'),
      '#default_value' => $this->get('registration_portal_id_slipstream', 179),
      '#description' => $this->t('Portal ID of iCOre.'),
      '#required' => TRUE,
    ];

  }

    /**
   * {@inheritdoc}
   */
  private function onlineRegisterConfig(array &$form) {
    $form['online_register_setting'] = [
      '#type' => 'details',
      '#title' => t('Registration Online Configuration'),
      '#group' => 'advanced',
    ];

    $form['online_register_setting']['register'] = [
      '#type' => 'details',
      '#title' => $this->t('Registration Online'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['online_register_setting']['register']['enable_register_online'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Registration Online - (✓)enable | (✕)disable'),
      '#default_value' => $this->get('enable_register_online'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['reg_api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Reg API v3 URL'),
      '#default_value' => $this->get('reg_api_url'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['reg_api_error_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Reg API v3 Error Mapping'),
      '#default_value' => $this->get('reg_api_error_mapping'),
      '#description' => $this->t('Registration API v3 Response Code Mapping Message. Format example: {StatusCode}|{Message}'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['online_register_setting']['register']['registration_jpay_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPay Integration Url'),
      '#default_value' => $this->get('registration_jpay_url'),
      '#description' => $this->t('JPay API url for registration account creation.'),
      '#required' => TRUE,
    ];

    $form['online_register_setting']['register']['registration_jpay_site_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site ID'),
      '#default_value' => $this->get('registration_jpay_site_id'),
      '#description' => $this->t('Site ID of MSW.'),
      '#required' => TRUE,
    ];

    $form['online_register_setting']['register']['registration_portal_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Portal ID'),
      '#default_value' => $this->get('registration_portal_id', 177),
      '#description' => $this->t('Portal ID of iCOre.'),
      '#required' => TRUE,
    ];

    $form['online_register_setting']['register']['registration_marketing_channel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Marketing Channel'),
      '#default_value' => $this->get('registration_marketing_channel'),
      '#description' => $this->t('Default Marketing Channel.'),
      '#required' => FALSE,
    ];

    $form['online_register_setting']['register']['registration_btag'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Btag'),
      '#default_value' => $this->get('registration_btag'),
      '#description' => $this->t('Default Btag'),
      '#required' => FALSE,
    ];

    $body_content = $this->get('success_message');
    $form['online_register_setting']['register']['success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];
  }
}
