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
    $this->mswHiddenTitle($form);
    $this->helpCenterConfig($form);
    $this->prioritizationMenuConfig($form);
    $this->customerSupportNotificationsConfig($form);

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

    $form['registration_setting']['registration']['enable_register_upload_img'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Registration Fields - (✓)hide | (✕)show ID 2 option'),
      '#default_value' => $this->get('enable_register_upload_img'),
      '#translatable' => TRUE,
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

    $form['online_register_setting']['register']['enable_register_online_join_btn'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Join Button - (✓)enable | (✕)disable'),
      '#default_value' => $this->get('enable_register_online_join_btn'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields'] = [
      '#type' => 'details',
      '#title' => $this->t('Registration Online Fields - (✓)hide | (✕)show'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields']['enable_register_online_source_of_income'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Source of Income'),
      '#default_value' => $this->get('enable_register_online_source_of_income'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields']['enable_register_online_nationality'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Nationality'),
      '#default_value' => $this->get('enable_register_online_nationality'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields']['enable_register_online_security_questions'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Security Questions'),
      '#default_value' => $this->get('enable_register_online_security_questions'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields']['enable_register_online_rfidpin'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('RFID Pin'),
      '#default_value' => $this->get('enable_register_online_rfidpin'),
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['register_online_form_fields']['enable_register_online_contact_preference'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Contact Preference'),
      '#default_value' => $this->get('enable_register_online_contact_preference'),
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

    $form['online_register_setting']['register']['video_call_URL'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Customer Support Video Call'),
      '#default_value' => $this->get('video_call_URL'),
      '#description' => $this->t('Customer Support Video Call'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $body_content = $this->get('success_message');
    $form['online_register_setting']['register']['success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];

    $form['online_register_setting']['register']['outlets_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Outlets List'),
      '#default_value' => $this->get('outlets_list'),
      '#description' => $this->t('List of Home Outlets. Provide a list separated by pipe, in the form of
        {Index}|{Province}|{City}|{Outlet Name}|{Outlet Id}.'),
      '#required' => TRUE,
    ];
  }

  private function mswHiddenTitle(array &$form) {
    $form['msw_hidden_title'] = [
      '#type' => 'details',
      '#title' => t('MSW SEO Hidden Title'),
      '#group' => 'advanced',
    ];

    $form['msw_hidden_title']['msw_hidden_title_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('MSW SEO Hidden title value'),
      '#default_value' => $this->get('msw_hidden_title_value'),
      '#description' => $this->t('Here we can add title that will be hidden under logo on header part'),
      '#translatable' => TRUE,
    ];
  }

  private function helpCenterConfig(array &$form) {
    $form['help_center_setting'] = [
      '#type' => 'details',
      '#title' => t('Help Center Configuration'),
      '#group' => 'advanced',
    ];

    $form['help_center_setting']['help_center'] = [
      '#type' => 'details',
      '#title' => $this->t('Help Center'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['help_center_setting']['help_center']['enable_help_center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Help Center'),
      '#default_value' => $this->get('enable_help_center'),
      '#translatable' => TRUE,
    ];

    $form['help_center_setting']['help_center']['help_center_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Help Center Title'),
      '#default_value' => $this->get('help_center_title'),
      '#translatable' => TRUE,
    ];
  }

  private function customerSupportNotificationsConfig(array &$form) {
    $form['customer_support_notifications_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('CS Email Notification'),
      '#group' => 'advanced'
    ];
    $form['customer_support_notifications_settings']['cs_reg_email_notification']['cs_reg_email_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Email notifications to cs on new player registration'),
      '#default_value' => $this->get('cs_reg_email_enable'),
      '#translatable' => TRUE,
    ];

    $form['customer_support_notifications_settings']['cs_reg_email_notification']['cs_reg_email_sender'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sender'),
      '#default_value' => $this->get('cs_reg_email_sender'),
      '#translatable' => TRUE,
    ];

    $form['customer_support_notifications_settings']['cs_reg_email_notification']['cs_reg_email_recipients'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Recipients'),
      '#default_value' => $this->get('cs_reg_email_recipients'),
      '#translatable' => TRUE,
    ];

    $form['customer_support_notifications_settings']['cs_reg_email_notification']['cs_reg_email_template'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Email Template'),
      '#default_value' => $this->get('cs_reg_email_template')['value'],
      '#format' => $this->get('cs_reg_email_template')['format'],
      '#translatable' => TRUE,
    ];
  }

  private function prioritizationMenuConfig(array &$form) {
    $form['prioritization_menu_config'] = [
      '#type' => 'details',
      '#title' => t('Video Call Prioritization Menu Configuration'),
      '#group' => 'advanced',
    ];

    $form['prioritization_menu_config']['prioritization_menu'] = [
      '#type' => 'details',
      '#title' => $this->t('Video Call Prioritization Menu'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['prioritization_menu_config']['prioritization_menu']['prioritization_menu_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Video Call Prioritization Menu Title'),
      '#default_value' => $this->get('prioritization_menu_title'),
      '#translatable' => TRUE,
    ];

    $form['prioritization_menu_config']['prioritization_menu']['prioritization_menu_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Video Call Prioritization Menu Blurb'),
      '#default_value' => $this->get('prioritization_menu_blurb'),
      '#translatable' => TRUE,
    ];

  }
}
