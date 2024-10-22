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
    $this->myProfile($form);
    $this->contactPreferences($form);
    $this->customerSupport($form);
    $this->sectionPageSetting($form);
    $this->fieldMessage($form);
    $this->verifyPassword($form);
    $this->revisePasswordAlert($form);

    return $form;
  }

  /**
   *
   */
  private function myProfile(array &$form) {
    $form['my_profile'] = [
      '#type' => 'details',
      '#title' => t('My profile config'),
      '#group' => 'advanced',
    ];

    $form['my_profile']['no_update'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No update text'),
      '#description' => $this->t('Text when profile is submit but no update'),
      '#default_value' => $this->get('no_update'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
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

    $form['preferences']['contact_preference_yes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label for Yes'),
      '#description' => 'This will appear on verification profile submit',
      '#default_value' => $this->get('contact_preference_yes'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['preferences']['contact_preference_no'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No label'),
      '#description' => 'This will appear on verification profile submit',
      '#default_value' => $this->get('contact_preference_no'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['preferences']['contact_preference_top_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Top blurb'),
      '#default_value' => $this->get('contact_preference_top_blurb'),
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

  }

  private function fieldMessage(array &$form) {
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

  private function verifyPassword(array &$form) {
    $form['verify_password_group'] = [
      '#type' => 'details',
      '#title' => 'Verify Password',
      '#group' => 'advanced',
    ];

    $form['verify_password_group']['modal_current'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal current label'),
      '#default_value' => $this->get('modal_current'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['modal_new'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal new label'),
      '#default_value' => $this->get('modal_new'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['modal_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal header blurb'),
      '#default_value' => $this->get('modal_header'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['modal_top'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal top blurb'),
      '#default_value' => $this->get('modal_top'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['modal_bottom'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal bottom blurb'),
      '#default_value' => $this->get('modal_bottom'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['message_timeout'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message timeout'),
      '#default_value' => $this->get('message_timeout'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['verify_password_group']['server_side_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Server side mapping'),
      '#description' => 'UPDATE_PROFILE_SUCCESS|Profile updated <br>
                        UPDATE_PROFILE_FAILED|Update failed',
      '#default_value' => $this->get('server_side_mapping'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  private function revisePasswordAlert(array &$form) {
      $form['revise_password'] = [
          '#type' => 'details',
          '#title' => t('Revise Password Alert'),
          '#group' => 'advanced',
      ];

      $form['revise_password']['enable_revise_password'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable revise password alert - (✓)enable | (✕)disable'),
        '#default_value' => $this->get('enable_revise_password'),
        '#translatable' => TRUE,
      ];

      $form['revise_password']['revise_password_title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Revise password alert title'),
          '#required' => true,
          '#default_value' => $this->get('revise_password_title'),
          '#translatable' => true,
      ];

      $content = $this->get('revise_password_content');
      $form['revise_password']['revise_password_content'] = [
          '#type' => 'text_format',
          '#title' => $this->t('Revise Password Alert Content'),
          '#default_value' => $content['value'],
          '#translatable' => TRUE,
      ];
  }
}
