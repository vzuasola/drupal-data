<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for the Auto Logout Fucntionality.
 */
class SessionTimeoutConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.autologout_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'autologout_config_settings_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.autologout_config');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];
    $form['session_timeout_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Settings'),
      '#group' => 'advanced',
    ];

    $form['session_timeout_details']['session_maxtime'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Maximum Session Time'),
      '#required' => TRUE,
      '#default_value' => $config->get('session_maxtime'),
      '#description' => $this->t('The maximum time after which the Player gets automatically logged Out.'),
    ];

    $form['lightbox_details'] = [
      '#type' => 'details',
      '#title' => t('Auto Logout Box Settings'),
      '#group' => 'advanced',
    ];

    $form['lightbox_details']['autologout_box_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Auto Logout LightBox Title'),
      '#required' => TRUE,
      '#description' => $this->t('The Title of the Auto Logout LightBox.'),
      '#default_value' => $config->get('autologout_box_title'),
    ];

    $form['lightbox_details']['autologout_box_content'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Auto Logout LightBox Content'),
      '#required' => TRUE,
      '#description' => $this->t('The Content of the Auto Logout LightBox.'),
      '#default_value' => $config->get('autologout_box_content'),
    ];

    $form['lightbox_details']['affirmative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Affirmative Response text'),
      '#required' => TRUE,
      '#description' => $this->t('The Affirmative Button text in Auto Logout LightBox.'),
      '#default_value' => $config->get('affirmative_button_text'),
    ];

    $form['lightbox_details']['negative_button_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Negative Response text'),
      '#required' => TRUE,
      '#description' => $this->t('The Negative response Button text in Auto Logout LightBox.'),
      '#default_value' => $config->get('negative_button_text'),
    ];

    $form['notification_box_details'] = [
      '#type' => 'details',
      '#title' => t('Notification Box Settings'),
      '#group' => 'advanced',
    ];

    $form['notification_box_details']['notification_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Autologout Notification Box Title'),
      '#required' => TRUE,
      '#description' => $this->t('The Title of the Auto logout Notification LightBox'),
      '#default_value' => $config->get('notification_title'),
    ];

    $form['notification_box_details']['notification_content'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Autologout Notification Box Content'),
      '#required' => TRUE,
      '#description' => $this->t('The Content of the Auto logout Notification LightBox'),
      '#default_value' => $config->get('notification_content'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $autoLogoutValuesKeys = [
      'session_maxtime',
      'autologout_box_title',
      'autologout_box_content',
      'affirmative_button_text',
      'negative_button_text',
      'notification_title',
      'notification_content',
    ];
    foreach ($autoLogoutValuesKeys as $keys) {
      $this->config('casino_config.autologout_config')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
