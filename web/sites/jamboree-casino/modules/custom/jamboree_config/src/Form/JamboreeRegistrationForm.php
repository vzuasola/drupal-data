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

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionRegistrationForm(array &$form) {
    $form['reg_form'] = [
      '#type' => 'details',
      '#title' => t('Registration Form'),
      '#group' => 'advanced',
    ];

    $form['reg_form']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title.'),
      '#default_value' => $this->get('footer_blurb'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['reg_form_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('reg_form_title'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for First Name.'),
      '#default_value' => $this->get('first_name'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Last Name.'),
      '#default_value' => $this->get('last_name'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Password.'),
      '#default_value' => $this->get('password'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['cofirm_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Confirm Password.'),
      '#default_value' => $this->get('cofirm_password'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['gender'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Gender.'),
      '#default_value' => $this->get('gender'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['male'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Male.'),
      '#default_value' => $this->get('male'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['female'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Female.'),
      '#default_value' => $this->get('female'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Email.'),
      '#default_value' => $this->get('email'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['confirm_email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Confirm Email.'),
      '#default_value' => $this->get('confirm_email'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['date_of_birth'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Date of Birth.'),
      '#default_value' => $this->get('date_of_birth'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['contact_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Contact Number.'),
      '#default_value' => $this->get('contact_number'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['currency_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Currency.'),
      '#default_value' => $this->get('currency_label'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['currency_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the value for Currency.'),
      '#default_value' => $this->get('currency_value'),
      '#translatable' => TRUE,
    ];


    $form['reg_form']['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Country.'),
      '#default_value' => $this->get('country'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['country_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Please enter the label for Country List.'),
      '#default_value' => $this->get('country_list'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['prefecture'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Prefecture.'),
      '#default_value' => $this->get('prefecture'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['prefetcher_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Please enter the label for Prefetcher List.'),
      '#default_value' => $this->get('prefetcher_list'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['town_and_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Town and City.'),
      '#default_value' => $this->get('town_and_city'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['zip_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Zip-code.'),
      '#default_value' => $this->get('zip_code'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Address.'),
      '#default_value' => $this->get('address'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['terms_and_condition'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Terms and Condition.'),
      '#default_value' => $this->get('terms_and_condition'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['promotion_and_updates'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Promotion_and_updates and Updates.'),
      '#default_value' => $this->get('promotion'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['captcha'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Captcha.'),
      '#default_value' => $this->get('captcha'),
      '#translatable' => TRUE,
    ];

    $form['reg_form']['submit_button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please enter the label for Submit button.'),
      '#default_value' => $this->get('submit_button'),
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

    $form['step_3']['welcome_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Welcome Message'),
      '#default_value' => $this->get('welcome_message'),
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

    $form['step_3']['play_button_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Label'),
      '#default_value' => $this->get('play_button_label'),
      '#translatable' => TRUE,
    ];

    $form['step_3']['play_button_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Button Link'),
      '#default_value' => $this->get('play_button_link'),
      '#translatable' => TRUE,
    ];
  }
}
