<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_my_account",
 *   route = {
 *     "title" = "My Account Page Configuration",
 *     "path" = "/admin/config/zipang/my_account_configuration",
 *   },
 *   menu = {
 *     "title" = "My Account Page Configuration",
 *     "description" = "Provides My Account page configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangMyAccountConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.my_account_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('My Account Page Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['myacc'] = [
      '#type' => 'details',
      '#title' => t('My Account Page Setting'),
      '#group' => 'advanced',
    ];

    $form['myacc']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#default_value' => $this->get('page_title') ?? "My Account",
      '#translatable' => TRUE,
    ];

    $form['myacc']['profile_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Profile Title'),
      '#default_value' => $this->get('profile_title') ?? "Profile",
      '#translatable' => TRUE,
    ];

    $f = $this->get('footer_blurb') ?? "Footer Blurb";
    $form['myacc']['footer_blurb'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Footer Blurb'),
      '#default_value' => $f['value'],
      '#format' => $f['format'],
      '#translatable' => TRUE,
    ];

    $form['myacc']['account_details_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Account Details Section Title'),
      '#default_value' => $this->get('account_details_title') ?? "Account Details",
      '#translatable' => TRUE,
    ];

    $form['myacc']['communication_details_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Communication Details Section Title'),
      '#default_value' => $this->get('communication_details_title') ?? "Communication Details",
      '#translatable' => TRUE,
    ];

    $form['myacc']['home_address_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home Address Section Title'),
      '#default_value' => $this->get('home_address_title') ?? "Home Address",
      '#translatable' => TRUE,
    ];

    $form['account_details'] = [
      '#type' => 'details',
      '#title' => t('Account Details Inputs Labels'),
      '#group' => 'advanced',
    ];

    $form['account_details']['vip_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('VIP Level'),
      '#default_value' => $this->get('vip_label') ?? "VIP Level",
      '#translatable' => TRUE,
    ];

    $form['account_details']['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#default_value' => $this->get('username') ?? "Username",
      '#translatable' => TRUE,
    ];

    $form['account_details']['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Firstname'),
      '#default_value' => $this->get('firstname') ?? "Firstname",
      '#translatable' => TRUE,
    ];

    $form['account_details']['date_of_birth'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Date of Birth'),
      '#default_value' => $this->get('date_of_birth') ?? "Date of Birth",
      '#translatable' => TRUE,
    ];

    $form['account_details']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $this->get('country') ?? "Country",
      '#translatable' => TRUE,
    ];

    $form['account_details']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $this->get('country') ?? "Country",
      '#translatable' => TRUE,
    ];

    $form['account_details']['currency'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Currency'),
      '#default_value' => $this->get('currency') ?? "Currency",
      '#translatable' => TRUE,
    ];

    $form['account_details']['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lastname'),
      '#default_value' => $this->get('lastname') ?? "Lastname",
      '#translatable' => TRUE,
    ];

    $form['account_details']['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email Address'),
      '#default_value' => $this->get('email') ?? "Email Address",
      '#translatable' => TRUE,
    ];

    $form['account_details']['gender'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Gender'),
      '#default_value' => $this->get('gender') ?? "Gender",
      '#translatable' => TRUE,
    ];

    $form['account_details']['male'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Male'),
      '#default_value' => $this->get('male') ?? "Male",
      '#translatable' => TRUE,
    ];

    $form['account_details']['female'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Female'),
      '#default_value' => $this->get('female') ?? "Female",
      '#translatable' => TRUE,
    ];

    $form['communication_details'] = [
      '#type' => 'details',
      '#title' => t('Communication Details Inputs Labels'),
      '#group' => 'advanced',
    ];

    $form['communication_details']['mobile_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Number'),
      '#default_value' => $this->get('mobile_number') ?? "Mobile Number",
      '#translatable' => TRUE,
    ];

    $form['communication_details']['language'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Language'),
      '#default_value' => $this->get('language') ?? "Language",
      '#translatable' => TRUE,
    ];

    $d = $this->get('language_mapping') ?? "ja|Japan";
    $form['communication_details']['language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#default_value' => $d,
      '#format' => $d['format'],
      '#description' => 'Define the language mapping for languages. Pipe seperated code and language per line.',
      '#translatable' => TRUE,
    ];


    $form['home_address_details'] = [
      '#type' => 'details',
      '#title' => t('Home Address Inputs Labels'),
      '#group' => 'advanced',
    ];

    $form['home_address_details']['zip_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Zip Code/Postal Code'),
      '#default_value' => $this->get('zip_code') ?? "Zip Code/Postal Code",
      '#translatable' => TRUE,
    ];

    $form['home_address_details']['state'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Prefecture/State'),
      '#default_value' => $this->get('state') ?? "Prefecture/State",
      '#translatable' => TRUE,
    ];

    $form['home_address_details']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Town/City'),
      '#default_value' => $this->get('city') ?? "Town/City",
      '#translatable' => TRUE,
    ];

    $form['home_address_details']['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#default_value' => $this->get('address') ?? "Address",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon'] = [
      '#type' => 'details',
      '#title' => t('Promotion Coupon Labels'),
      '#group' => 'advanced',
    ];

    $form['promotion_coupon']['coupon_code_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Coupon Code'),
      '#default_value' => $this->get('coupon_code_enable'),
      '#translatable' => FALSE,
    ];

    $form['promotion_coupon']['coupon_code_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Coupon Code Title'),
      '#default_value' => $this->get('coupon_code_title') ?? "Coupon Code",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['coupon_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Coupon Code Label'),
      '#default_value' => $this->get('coupon_code') ?? "Coupon Code",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['coupon_placeholder'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Coupon Code Placeholder Label'),
      '#default_value' => $this->get('coupon_placeholder') ?? "Coupon Code",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['coupon_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Coupon Code Button Label'),
      '#default_value' => $this->get('coupon_button_label') ?? "Redeem",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['modal_header_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal Header Title'),
      '#default_value' => $this->get('modal_header_title') ?? "Message",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['coupon_success_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Message'),
      '#default_value' => $this->get('coupon_success_message') ?? "Coupon code has been applied",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['coupon_error_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Error Message'),
      '#default_value' => $this->get('coupon_error_message') ?? "Coupon code has not been applied",
      '#translatable' => TRUE,
    ];

    $form['promotion_coupon']['modal_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Modal Button Label'),
      '#default_value' => $this->get('modal_button_label') ?? "OK",
      '#translatable' => TRUE,
    ];
  }
}
