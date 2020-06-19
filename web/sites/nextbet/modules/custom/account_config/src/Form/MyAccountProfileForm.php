<?php

namespace Drupal\account_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My AccountProfile Form configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "profile_form",
 *   route = {
 *     "title" = "Profile Form",
 *     "path" = "/admin/config/my-account/profile",
 *   },
 *   menu = {
 *     "title" = "Profile Form Configuration",
 *     "description" = "Profile Form COnfiguration",
 *     "parent" = "account_config.list",
 *   },
 * )
 */
class MyAccountProfileForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return ['account_config.general_configuration'];
    }

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function form(array $form, FormStateInterface $form_state) {
        $form['profile'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['header_configuration'] = [
            '#type' => 'details',
            '#title' => 'Header Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];


        $form['header_configuration']['welcome_text'] = [
          '#type' => 'textfield',
          '#title' => t('Welcome text'),
          '#required' => TRUE,
          '#description' => $this->t('Text for welcome text appear at the header top navigation.'),
          '#default_value' => $this->get('welcome_text'),
          '#translatable' => TRUE,
        ];

        $form['header_configuration']['product_menu_new_tag'] = [
          '#type' => 'textfield',
          '#title' => t('New Tag'),
          '#required' => TRUE,
          '#description' => $this->t('Text for new tag'),
          '#default_value' => $this->get('product_menu_new_tag'),
          '#translatable' => TRUE,
        ];

        $form['header_configuration']['help_tooltip'] = [
          '#type' => 'textfield',
          '#title' => t('Help Tooltip'),
          '#required' => TRUE,
          '#description' => $this->t('Tooltip for help'),
          '#default_value' => $this->get('help_tooltip'),
          '#translatable' => TRUE,
        ];

        $form['header_configuration']['error_mid_down'] = [
          '#type' => 'textarea',
          '#title' => t('Error Message MID Down'),
          '#size' => 500,
          '#required' => TRUE,
          '#description' => $this->t('General Error Message across all forms of my account if MID is down.'),
          '#default_value' => $this->get('error_mid_down'),
          '#translatable' => TRUE,
        ];


        $form['field_labels_generic_configuration'] = [
            '#type' => 'details',
            '#title' => 'Generic Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_generic_configuration']['add_mobile_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for adding mobile number link'),
            '#required' => TRUE,
            '#default_value' => $this->get('add_mobile_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_generic_configuration']['no_changed_detected_message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Message if no changed has been detected'),
            '#required' => TRUE,
            '#default_value' => $this->get('no_changed_detected_message'),
            '#translatable' => TRUE,
        ];

        $form['contact_preference'] = [
            '#type' => 'details',
            '#title' => 'Contact Prefrence',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['contact_preference']['contact_preference_yes_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference True Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('contact_preference_yes_label'),
            '#translatable' => true,
        ];

        $form['contact_preference']['contact_preference_no_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference False Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('contact_preference_no_label'),
            '#translatable' => true,
        ];

        $form['field_labels_country_mapping'] = [
            '#type' => 'details',
            '#title' => 'Country Mapping',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_country_mapping']['country_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $this->get('country_mapping'),
        ];

        $form['field_labels_country_mapping']['country_code_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Code Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $this->get('country_code_mapping'),
        ];

        $form['field_labels_modal_preview'] = [
            '#type' => 'details',
            '#title' => 'Modal Preview',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_modal_preview']['modal_preview_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Header'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_header'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_top_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Top Blurb'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_top_blurb'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_current_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Current Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_current_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_modal_preview']['modal_preview_new_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview New Label'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_new_label'),
            '#translatable' => TRUE,
        ];

        $form['field_labels_modal_preview']['modal_preview_bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Bottom Blurb'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_bottom_blurb'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Password Placeholder'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_placeholder'),
            '#translatable' => true,
        ];

        $form['field_labels_modal_preview']['modal_preview_btn'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Button'),
            '#required' => TRUE,
            '#default_value' => $this->get('modal_preview_btn'),
            '#translatable' => true,
        ];

        $form['field_labels_validation_configuration'] = [
            '#type' => 'details',
            '#title' => 'Validation Configuration',
            '#open' => False,
            '#group' => 'profile',
        ];

        $form['field_labels_validation_configuration']['server_side_validation'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Server-side Validation Mapping'),
            '#required' => TRUE,
            '#default_value' => $this->get('server_side_validation'),
            '#translatable' => true,
        ];

        return $form;
    }
}
