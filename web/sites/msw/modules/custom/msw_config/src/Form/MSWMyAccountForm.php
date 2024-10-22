<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_my_account_form",
 *   route = {
 *     "title" = "My Account Page Configuration",
 *     "path" = "/admin/config/msw/my_account_configuration",
 *   },
 *   menu = {
 *     "title" = "My Account Page Configuration",
 *     "description" = "Provides my account page configuration",
 *     "parent" = "msw_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class MSWMyAccountForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['msw_config.my_account_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('My Account Configuration'),
        ];

        $this->myAccountTabs($form);
        $this->sectionPageSetting($form);
        $this->contactPreferences($form);
        $this->customerSupport($form);
        $this->revisePasswordAlert($form);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    private function sectionPageSetting(array &$form) {
        $form['page_profile_setting'] = [
            '#type' => 'details',
            '#title' => t('Profile Setting'),
            '#group' => 'advanced',
        ];

        $form['page_profile_setting']['server_side_validation'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Server-side Validation Mapping'),
            '#required' => TRUE,
            '#default_value' => $this->get('server_side_validation'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation'] = [
            '#type' => 'details',
            '#title' => 'Review Changes Lightbox Settings',
            '#open' => False,
        ];

        $form['page_profile_setting']['password_validation']['required_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Error Message'),
            '#required' => true,
            '#default_value' => $this->get('required_validation'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['password_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Placeholder'),
            '#required' => true,
            '#default_value' => $this->get('password_placeholder'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['submit_lightbox_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Lightbox Label'),
            '#required' => true,
            '#default_value' => $this->get('submit_lightbox_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Title'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_title'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_table_description'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Table Description'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_table_description'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['lightbox_password_description'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Lightbox Password Description'),
            '#required' => true,
            '#default_value' => $this->get('lightbox_password_description'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['saving_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Saving Message'),
            '#required' => true,
            '#default_value' => $this->get('saving_message'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['current_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current Label'),
            '#required' => true,
            '#default_value' => $this->get('current_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['password_validation']['new_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Label'),
            '#required' => true,
            '#default_value' => $this->get('new_label'),
            '#translatable' => true,
        ];

        $form['page_profile_setting']['form_settings'] = [
            '#type' => 'details',
            '#title' => 'Form Settings',
            '#open' => False,
        ];

        $form['page_profile_setting']['form_settings']['no_changes_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('The message to display if no changes made.'),
            '#required' => true,
            '#default_value' => $this->get('no_changes_message')
                ? $this->get('no_changes_message')
                : 'No changes have been detected.',
            '#translatable' => true,
        ];

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

        $c = $this->get('change_password_integration_error');
        $form['page_change_password_setting']['change_password_integration_error'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Integration Error Messages'),
            '#description' => $this->t('Integration error list.'),
            '#default_value' => $c['value'],
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

        $form['tabs']['account_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('My Account tab label'),
            '#required' => TRUE,
            '#default_value' => $this->get('account_tab'),
            '#translatable' => true,
            '#description' => 'Label for the account tab',
        ];

        $form['tabs']['history_tab'] = [
            '#type' => 'textfield',
            '#title' => $this->t('History tab label'),
            '#required' => TRUE,
            '#default_value' => $this->get('history_tab'),
            '#translatable' => true,
            '#description' => 'Label for the history tab',
        ];

        $form['tabs']['my_profile_tab'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Profile Tab'),
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

    /**
    *
    */
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

    /**
    *
    */
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
    *
    */
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
