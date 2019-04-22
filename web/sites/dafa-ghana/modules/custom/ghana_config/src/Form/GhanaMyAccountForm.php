<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_my_account_form",
 *   route = {
 *     "title" = "My Account Page Configuration",
 *     "path" = "/admin/config/ghana/my_account_configuration",
 *   },
 *   menu = {
 *     "title" = "My Account Page Configuration",
 *     "description" = "Provides my account page configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class GhanaMyAccountForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['ghana_config.my_account_configuration'];
    }

    public function form(array $form, FormStateInterface $form_state) {
        $form['advanced'] = [
            '#type' => 'vertical_tabs',
            '#title' => t('My Account Configuration'),
        ];

        $this->sectionPageSetting($form);

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

        $form['page_change_password_setting']['page_new_password_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Password Label'),
            '#default_value' => $this->get('page_new_password_label'),
            '#translatable' => true,
        ];

        $form['page_change_password_setting']['page_confirm_password_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Confirm Password Label'),
            '#default_value' => $this->get('page_confirm_password_label'),
            '#translatable' => true,
        ];


        $form['page_change_password_setting']['page_change_password_submit'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Button Label'),
            '#default_value' => $this->get('page_change_password_submit'),
            '#translatable' => true,
        ];


    }
}
