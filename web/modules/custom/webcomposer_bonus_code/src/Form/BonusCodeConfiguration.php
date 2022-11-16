<?php

namespace Drupal\webcomposer_bonus_code\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "bonus_code_configuration",
 *   route = {
 *     "title" = "Bonus Code Configuration",
 *     "path" = "/admin/config/webcomposer/config/bonus_code",
 *   },
 *   menu = {
 *     "title" = "Bonus Code Configuration",
 *     "description" = "Provides Webcomposer Bonus Code Configuration",
 *     "parent" = "webcomposer_bonus_code.list",
 *     "weight" = 30
 *   },
 * )
 */
class BonusCodeConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.bonus_code_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['bonus_code'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['general_configuration'] = [
      '#group' => 'bonus_code',
      '#type' => 'details',
      '#title' => 'General Configuration',
    ];

    $form['error_messages_configuration'] = [
      '#group' => 'bonus_code',
      '#type' => 'details',
      '#title' => 'Error Messages Configuration',
    ];

    $form['success_messages_configuration'] = [
      '#group' => 'bonus_code',
      '#type' => 'details',
      '#title' => 'Success Messages Configuration',
    ];

    $this->generalConfig($form);
    $this->errorMessagesConfig($form);
    $this->successMessagesConfig($form);

    return $form;
  }

  /**
   * @param mixed $form
   * @return mixed
   * @throws \Drupal\Core\DependencyInjection\ContainerNotInitializedException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
   */
  public function generalConfig(&$form)
  {
    $form['general_configuration']['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $this->get('enabled'),
      '#description' => $this->t('Check to enable Bonus Code Feature'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];

    $form['general_configuration']['mobile_tab_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Tab Label'),
      '#default_value' => $this->get('mobile_tab_label') ?? 'Bonuses',
      '#description' => $this->t('Mobile Bonuses Tab to be display'),
      '#maxlength' => 50,
      '#translatable' => TRUE,
    ];

    return $form;
  }

  /**
   * @param mixed $form
   * @return mixed
   * @throws \Drupal\Core\DependencyInjection\ContainerNotInitializedException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
   */
  public function errorMessagesConfig(&$form)
  {

    $form['error_messages_configuration']['default_error_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Error Message'),
      '#default_value' => $this->get('default_error_message') ?? 'Something went wrong, please try again later.',
      '#description' => $this->t('Default Error Message to be displayed'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];

    $form['error_messages_configuration']['invalid_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Invalid Code Error Message'),
      '#default_value' => $this->get('invalid_code') ?? 'Invalid Bonus Code',
      '#description' => $this->t('Invalid Code Error Message to be displayed'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];


    $form['error_messages_configuration']['code_already_submited'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Code Already Submited Error Message'),
      '#default_value' => $this->get('code_already_submited') ?? 'Code already submited!',
      '#description' => $this->t('Code Already Submited Message to be displayed'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];

    return $form;
  }

  /**
   * @param mixed $form
   * @return mixed
   * @throws \Drupal\Core\DependencyInjection\ContainerNotInitializedException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
   * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
   */
  public function successMessagesConfig(&$form)
  {
    $content = $this->get('success_messsage');
    $form['success_messages_configuration']['success_messsage'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#description' => $this->t('Message to be displayed upon successful submittion of Bonus Code'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];

    $form['success_messages_configuration']['valid_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Valid Code Error Message'),
      '#default_value' => $this->get('valid_code') ?? 'Bonus Code is valid',
      '#description' => $this->t('Valid Code Message to be displayed'),
      '#maxlength' => 500,
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
