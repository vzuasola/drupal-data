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
    $form['reg_form_settings'] = [
      '#type' => 'details',
      '#title' => t('Registration Form Settings'),
      '#group' => 'advanced',
    ];
    $form['reg_form_settings']['reg_form_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Registration API Hostname'),
      '#default_value' => $this->get('reg_form_host'),
      '#translatable' => TRUE,
    ];
    $form['reg_form_settings']['casino_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Name'),
      '#default_value' => $this->get('casino_name'),
      '#translatable' => TRUE,
    ];

    $form['reg_form_settings']['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Secret Key'),
      '#default_value' => $this->get('secret_key'),
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
