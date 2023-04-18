<?php

namespace Drupal\my_account_form_profile\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Routing\RequestContext;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\webcomposer_config_schema\Form\FormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class MyAccountChangePasswordForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_form_profile.change_password'];
  }

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['change_password'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_icore_validation'] = [
      '#type' => 'details',
      '#title' => 'Integration Validation',
      '#group' => 'change_password',
    ];

    $form['field_icore_validation']['integration_error'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Integration Error Messages'),
      '#description' => $this->t('Integration error list.'),
      '#default_value' => $this->get('integration_error'),
      '#translatable' => TRUE,
    ];

    $form['field_success_message_group'] = [
      '#type' => 'details',
      '#title' => 'Mobile Response - Messages',
      '#group' => 'change_password',
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

    $this->generalPasswordStrengthConfig($form);

    return $form;
  }

  private function generalPasswordStrengthConfig(array &$form)
  {
    $form['translations'] = [
      '#type' => 'details',
      '#title' => $this->t('Translations Settings'),
      '#collapsible' => TRUE,
      '#group' => 'change_password',
    ];

    //password strength feature flag checkbox
    $form['translations']['use_cms_password_strength'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Password Strength'),
      '#description' => $this->t('Enable password strength cms translation.'),
      '#default_value' => $this->get('use_cms_password_strength'),
      '#translatable' => TRUE,
    ];

    //label
    $form['translations']['password_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Label'),
      '#description' => $this->t('Password Label text for password strength.'),
      '#default_value' => $this->get('password_label'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];
    //weak
    $form['translations']['password_weak'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Weak'),
      '#description' => $this->t('Password Weak text for password strength.'),
      '#default_value' => $this->get('password_weak'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];
    //average
    $form['translations']['password_average'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Average'),
      '#description' => $this->t('Password Average text for password strength.'),
      '#default_value' => $this->get('password_average'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];

    //strong
    $form['translations']['password_strong'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Password Strong'),
      '#description' => $this->t('Password Strong text for password strength.'),
      '#default_value' => $this->get('password_strong'),
      '#maxlength' => 255,
      '#translatable' => TRUE,
    ];
  }

}
