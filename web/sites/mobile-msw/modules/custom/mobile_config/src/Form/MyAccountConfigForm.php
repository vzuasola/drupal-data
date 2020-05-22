<?php

namespace Drupal\mobile_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_config",
 *   route = {
 *     "title" = "My Account Page Configuration",
 *     "path" = "/admin/config/my_account/my_account_configurations",
 *   },
 *   menu = {
 *     "title" = "My Account Page Configuration",
 *     "description" = "Provides my account page configuration",
 *     "parent" = "mobile_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class MyAccountConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_config.my_account_configurations'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->myAccountTabs($form);
    $this->contactPreferences($form);
    $this->customerSupport($form);
    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   *
   */
  private function myAccountTabs(array &$form) {
    $form['tabs'] = [
      '#type' => 'details',
      '#title' => t('My Account Tabs'),
      '#group' => 'advanced',
    ];

    $form['tabs']['my_profile_tab'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My Profile Tab'),
      '#description' => $this->t('Tab title for my profile'),
      '#default_value' => $this->get('my_profile_tab'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['tabs']['change_password_tab'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Change Password Tab'),
      '#description' => $this->t('Tab title for change password'),
      '#default_value' => $this->get('change_password_tab'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  private function contactPreferences(array &$form) {
    $form['preferences'] = [
      '#type' => 'details',
      '#title' => t('Contact Preferences'),
      '#group' => 'advanced',
    ];

    $form['preferences']['contact_preference_top_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Top blurb'),
      '#default_value' => $this->get('contact_preference_top_blurb'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['preferences']['contact_preference_check_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Checkbox blurb'),
      '#default_value' => $this->get('contact_preference_check_blurb'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['preferences']['contact_preference_bottom_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Bottom blurb'),
      '#default_value' => $this->get('contact_preference_bottom_blurb'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  private function customerSupport(array &$form) {
    $form['support'] = [
      '#type' => 'details',
      '#title' => t('Customer Support'),
      '#group' => 'advanced',
    ];

    $content = $this->get('customer_support_blurb');
    $form['support']['customer_support_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Customer support blurb'),
      '#default_value' => $content['value'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
  * {@inheritdoc}
  */
  private function sectionPageSetting(array &$form) {
      // Change password Setting
      $form['page_change_password_setting'] = [
          '#type' => 'details',
          '#title' => t('Change Password Setting'),
          '#group' => 'advanced',
      ];

      $form['page_change_password_setting']['page_current_password_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Current Password Label'),
          '#default_value' => $this->get('page_current_password_label'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_current_password_placeholder'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Current Password Placeholder'),
          '#default_value' => $this->get('page_current_password_placeholder'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_new_password_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('New Password Label'),
          '#default_value' => $this->get('page_new_password_label'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_new_password_placeholder'] = [
          '#type' => 'textfield',
          '#title' => $this->t('New Password Placeholder'),
          '#default_value' => $this->get('page_new_password_placeholder'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_confirm_password_label'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Confirm Password Label'),
          '#default_value' => $this->get('page_confirm_password_label'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_confirm_password_placeholder'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Confirm Password Placeholder'),
          '#default_value' => $this->get('page_confirm_password_placeholder'),
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['page_change_password_submit'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Submit Button Label'),
          '#default_value' => $this->get('page_change_password_submit'),
          '#translatable' => true,
      ];

      $c = $this->get('page_change_password_desc');
      $form['page_change_password_setting']['page_change_password_desc'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Form Description'),
          '#default_value' => $c['value'],
          '#format' => $c['format'],
          '#translatable' => true,
      ];

      $form['page_change_password_setting']['change_password_integration_error'] = [
          '#type' => 'textarea',
          '#title' => $this->t('Integration Error Messages'),
          '#description' => $this->t('Integration error list.'),
          '#default_value' => $this->get('change_password_integration_error'),
          '#translatable' => TRUE,
      ];

      $form['field_success_message_group'] = [
        '#type' => 'details',
        '#title' => 'Mobile Response - Messages',
        '#group' => 'advanced',
      ];

      $content = $this->get('change_password_mobile_success_message');
      $form['field_success_message_group']['change_password_mobile_success_message'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Success Message'),
        '#default_value' => $content['value'],
        '#format' => $content['format'],
        '#required' => TRUE,
        '#translatable' => TRUE,
      ];
  
      $content = $this->get('change_password_mobile_failed_message');
      $form['field_success_message_group']['change_password_mobile_failed_message'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Failed Message'),
        '#default_value' => $content['value'],
        '#format' => $content['format'],
        '#required' => TRUE,
        '#translatable' => TRUE,
      ];

  }
}
