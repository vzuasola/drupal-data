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
}
