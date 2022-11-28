<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_registration",
 *   route = {
 *     "title" = "Registration Configuration",
 *     "path" = "/admin/config/jamboree/registration_configuration",
 *   },
 *   menu = {
 *     "title" = "Registration Configuration",
 *     "description" = "Provides registration configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeRegistrationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.registration_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Registration Configuration'),
    ];

    $this->sectionRegistrationForm($form);
    $this->sectionStep2($form);
    $this->sectionStep3($form);
    $this->sectionStep4($form);
    $this->sectionIcoreIntegration($form);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionRegistrationForm(array &$form) {
    // form setting
    $form['reg_form'] = [
      '#type' => 'details',
      '#title' => t('Registration Form'),
      '#group' => 'advanced',
    ];
    $form['reg_form']['form'] = [
      '#type' => 'fieldset',
      '#title' => t('Registration Form'),
    ];
    $form['reg_form']['form']['reg_form_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Page Title'),
      '#default_value' => $this->get('reg_form_title'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['reg_form_link_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Page Link Title (Step 1)'),
      '#default_value' => $this->get('reg_form_link_title'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['reg_form_step_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Form (Step 1)'),
      '#default_value' => $this->get('reg_form_step_1'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['reg_form_step_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Form (Step 2)'),
      '#default_value' => $this->get('reg_form_step_2'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['reg_form_step_3'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Form (Step 3)'),
      '#default_value' => $this->get('reg_form_step_3'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['reg_form_step_4'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Form (Step 4)'),
      '#default_value' => $this->get('reg_form_step_4'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['back_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Back Label'),
      '#default_value' => $this->get('back_label'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['next_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Label'),
      '#default_value' => $this->get('next_label'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['submit_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Submit Label'),
      '#default_value' => $this->get('submit_label'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['form']['year_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Year Label'),
      '#default_value' => $this->get('year_label'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['month_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Month Label'),
      '#default_value' => $this->get('month_label'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['form']['day_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Day Label'),
      '#default_value' => $this->get('day_label'),
      '#translatable' => TRUE,
    ];

    // error message setting
    $form['reg_form']['errors'] = [
      '#type' => 'fieldset',
      '#title' => t('Registration Error Messages'),
    ];
    $form['reg_form']['errors']['error_username'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Username Field'),
      '#default_value' => $this->get('error_username'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_firstname'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Firstname Field'),
      '#default_value' => $this->get('error_firstname'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_lastname'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Lastname Field'),
      '#default_value' => $this->get('error_lastname'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_password'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Password Field'),
      '#default_value' => $this->get('error_password'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_confirm_password'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Confirm Password Field'),
      '#default_value' => $this->get('error_confirm_password'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_email'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Email Field'),
      '#default_value' => $this->get('error_email'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_confirm_email'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Confirm Email Field'),
      '#default_value' => $this->get('error_confirm_email'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_birthdate'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Birthdate Field'),
      '#default_value' => $this->get('error_birthdate'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_phone'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Phone Field'),
      '#default_value' => $this->get('error_phone'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_currency'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Currency Field'),
      '#default_value' => $this->get('error_currency'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_country'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Country Field'),
      '#default_value' => $this->get('error_country'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_prefecture'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Prefecture Field'),
      '#default_value' => $this->get('error_prefecture'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_state'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for State Field'),
      '#default_value' => $this->get('error_state'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_city'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for City Field'),
      '#default_value' => $this->get('error_city'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_zipcode'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Zip code Field'),
      '#default_value' => $this->get('error_zipcode'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_address'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Address Field'),
      '#default_value' => $this->get('error_address'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_couponcode'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Coupon Code Field'),
      '#default_value' => $this->get('error_couponcode'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_term_conditions'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Terms and Conditions Field'),
      '#default_value' => $this->get('error_term_conditions'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_captcha'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Captcha Field'),
      '#default_value' => $this->get('error_captcha'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_promotions'] = [
      '#type' => 'textfield',
      '#title' => t('Registration Error Message for Promotions Field'),
      '#default_value' => $this->get('error_promotions'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['error_captcha'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Error Message for Captcha Field'),
      '#default_value' => $this->get('error_captcha'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['service_not_available'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Error Message if Service is not Available'),
      '#default_value' => $this->get('service_not_available'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['icore_username_validation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Error Message if Username is already exists'),
      '#default_value' => $this->get('icore_username_validation'),
      '#translatable' => TRUE,
    ];
    $form['reg_form']['errors']['icore_email_validation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration Error Message if Email is already exists'),
      '#default_value' => $this->get('icore_email_validation'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function sectionStep2(array &$form) {
    $form['step_2'] = [
      '#type' => 'details',
      '#title' => t('Registration Step 2'),
      '#group' => 'advanced',
    ];

    $form['step_2']['step_2_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('step_2_title'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['step_2_link_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Title'),
      '#default_value' => $this->get('step_2_link_title'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['success_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Success Message'),
      '#default_value' => $this->get('success_message'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('step_2_body');
    $form['step_2']['step_2_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Body'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['step_2']['step_2_deposit_bonus_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Deposit Bonus Title'),
      '#default_value' => $this->get('step_2_deposit_bonus_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('step_2_deposit_bonus');
    $form['step_2']['step_2_deposit_bonus'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Deposit Bonus'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['step_2']['step_2_play_now_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Title'),
      '#default_value' => $this->get('step_2_play_now_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('step_2_play_now');
    $form['step_2']['step_2_play_now'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Play Now'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['step_2']['promotion_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Label'),
      '#default_value' => $this->get('promotion_label'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['promotion_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Link'),
      '#default_value' => $this->get('promotion_link'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['cashier_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Label'),
      '#default_value' => $this->get('cashier_label'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['cashier_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Link'),
      '#default_value' => $this->get('cashier_link'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['next_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Button Label'),
      '#default_value' => $this->get('next_button_label'),
      '#translatable' => TRUE,
    ];

    $form['step_2']['next_button_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Button Link'),
      '#default_value' => $this->get('next_button_link'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function sectionStep3(array &$form) {
    $form['step_3'] = [
      '#type' => 'details',
      '#title' => t('Registration Step 3'),
      '#group' => 'advanced',
    ];

    $form['step_3']['step_3_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('step_3_title'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['step_3_link_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Title'),
      '#default_value' => $this->get('step_3_link_title'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['success_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Success Message'),
      '#default_value' => $this->get('success_message'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('step_3_body');
    $form['step_3']['step_3_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Body'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['step_3']['promotion_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Label'),
      '#default_value' => $this->get('promotion_label'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['promotion_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Link'),
      '#default_value' => $this->get('promotion_link'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['cashier_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Label'),
      '#default_value' => $this->get('cashier_label'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['cashier_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cashier Link'),
      '#default_value' => $this->get('cashier_link'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['next_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Button Label'),
      '#default_value' => $this->get('next_button_label'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['next_button_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Next Button Link'),
      '#default_value' => $this->get('next_button_link'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function sectionStep4(array &$form) {
    $form['step_4'] = [
      '#type' => 'details',
      '#title' => t('Registration Step 4'),
      '#group' => 'advanced',
    ];

    $form['step_4']['step_4_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('step_4_title'),
      '#translatable' => TRUE,
    ];

    $form['step_4']['step_4_link_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link Title'),
      '#default_value' => $this->get('step_4_link_title'),
      '#translatable' => TRUE,
    ];

    $form['step_4']['welcome_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Welcome Message'),
      '#default_value' => $this->get('welcome_message'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('step_4_body');
    $form['step_4']['step_4_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Body'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['step_4']['play_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Label'),
      '#default_value' => $this->get('play_button_label'),
      '#translatable' => TRUE,
    ];

    $form['step_4']['play_button_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Link'),
      '#default_value' => $this->get('play_button_link'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function sectionIcoreIntegration(array &$form) {
    $form['icore_integration'] = [
      '#type' => 'details',
      '#title' => t('Icore Integration Settings'),
      '#group' => 'advanced',
    ];

    $form['icore_integration']['jpay_api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPAY API Endpoint'),
      '#default_value' => $this->get('jpay_api_url'),
      '#description' => $this->t('Endpoint for JPAY API'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['icore_integration']['jpay_site_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JPAY Site ID'),
      '#default_value' => $this->get('jpay_site_id'),
      '#description' => $this->t('JPAY Site ID'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['icore_integration']['reg_api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration API URL'),
      '#default_value' => $this->get('reg_api_url'),
      '#description' => $this->t('Endpoint for registration API'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['icore_integration']['enable_reg_api_auth'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Registration API Authentication'),
      '#description' => $this->t('tick the checkbox to enable pass headers to authenticate to Registration API'),
      '#default_value' => $this->get('enable_reg_api_auth')
    ];

    $form['icore_integration']['reg_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Registration API KEY'),
      '#default_value' => $this->get('reg_api_key'),
      '#description' => $this->t('Key that will be used for the authentication mechanism for Reg API'),
      '#translatable' => TRUE,
    ];

    $form['icore_integration']['enable_email_validation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Email Validation'),
      '#description' => $this->t('Enable / disable email validation'),
      '#default_value' => $this->get('enable_email_validation')
    ];

    $form['icore_integration']['enable_username_validation'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Username Validation'),
      '#description' => $this->t('Enable / disable username validation'),
      '#default_value' => $this->get('enable_email_validation')
    ];



  }
}
