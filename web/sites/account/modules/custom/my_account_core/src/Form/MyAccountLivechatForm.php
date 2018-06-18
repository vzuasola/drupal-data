<?php

namespace Drupal\my_account_core\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account - Live Chat configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_core.livechat",
 *   route = {
 *     "title" = "My Account - Livechat Configuration",
 *     "path" = "/admin/config/my_account/livechat",
 *   },
 *   menu = {
 *     "title" = "My Account - Live Chat",
 *     "description" = "My account - livechat configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountLivechatForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_core.livechat'];
  }

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['livechat'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'livechat',
    ];

    $form['field_configuration']['live_chat_text'] = [
      '#type' => 'textfield',
      '#title' => t('Live Chat text'),
      '#size' => 255,
      '#required' => TRUE,
      '#description' => $this->t('Text for Live Link.'),
      '#default_value' => $this->get('live_chat_text'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['live_chat_link'] = [
      '#type' => 'textarea',
      '#title' => t('Live Chat Link'),
      '#size' => 500,
      '#required' => TRUE,
      '#description' => $this->t('Link for Live Chat.'),
      '#default_value' => $this->get('live_chat_link'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['field_jwt_configuration'] = [
      '#type' => 'details',
      '#title' => 'JWT Config',
      '#group' => 'livechat',
    ];

    $form['field_configuration']['field_jwt_configuration']['jwt_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('JWT Enabled'),
      '#description' => $this->t('Check this if you want to enable JWT'),
      '#maxlength' => 255,
      '#size' => 10,
      '#default_value' => $this->get('jwt_enabled'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['field_jwt_configuration']['url_post'] = [
      '#type' => 'url',
      '#title' => $this->t('URL Post'),
      '#description' => $this->t('URL that JWT will be posted'),
      '#maxlength' => 255,
      '#default_value' => $this->get('url_post'),
    ];

    $form['field_configuration']['field_jwt_configuration']['url_post_timout'] = [
      '#type' => 'number',
      '#title' => $this->t('URL Post Timeout'),
      '#description' => $this->t('Ajax Timeout'),
      '#maxlength' => 255,
      '#default_value' => $this->get('url_post_timout'),
    ];

    $form['field_configuration']['field_jwt_configuration']['jwt_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JWT Key'),
      '#description' => $this->t('Key for JWT'),
      '#size' => 255,
      '#default_value' => $this->get('jwt_key'),
    ];

    $form['field_configuration']['field_jwt_configuration']['validity_time'] = [
      '#type' => 'number',
      '#title' => $this->t('Validation Time (Seconds)'),
      '#description' => $this->t('Time of validity of JWT Token in seconds.'),
      '#maxlength' => 255,
      '#default_value' => $this->get('validity_time'),
    ];

    $form['field_configuration']['field_jwt_configuration']['xDomain_proxy'] = [
      '#type' => 'url',
      '#title' => $this->t('XDomain Proxy'),
      '#description' => $this->t('The protocol and domain of the XDomain proxy for CORS support (eg. https://www.cs-livechatcom)'),
      '#maxlength' => 255,
      '#default_value' => $this->get('xDomain_proxy'),
    ];

    return $form;
  }

}
