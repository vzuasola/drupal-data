<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class LiveChatConfiguration extends ConfigFormBase {

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get Form configuration.
    $config = $this->config('webcomposer_config.livechat_configuration');
    $form['livechat'] = [
        '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'livechat',
      '#open' => true,
      '#tree' => true,
    ];

    $form['field_configuration']['live_chat_text'] = [
      '#type' => 'textfield',
      '#title' => t('Live Chat text'),
      '#size' => 255,
      '#required' => true,
      '#description' => $this->t('Text for Live Link.'),
      '#default_value' => $config->get('live_chat_text')
    ];

    $form['field_configuration']['live_chat_link'] = [
      '#type' => 'textarea',
      '#title' => t('Live Chat Link'),
      '#size' => 500,
      '#required' => true,
      '#description' => $this->t('Link for Live Chat.'),
      '#default_value' => $config->get('live_chat_link')
    ];

    $form['field_configuration']['field_jwt_configuration'] = [
      '#type' => 'details',
      '#title' => 'JWT Config',
      '#group' => 'livechat'
    ];

    $form['field_configuration']['field_jwt_configuration']['jwt_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('JWT Enabled'),
      '#description' => $this->t('Check this if you want to enable JWT'),
      '#size' => 10,
      '#default_value' => $config->get('jwt_config')['jwt_enabled']
    ];

    $form['field_configuration']['field_jwt_configuration']['url_post'] = [
      '#type' => 'url',
      '#title' => $this->t('URL Post'),
      '#description' => $this->t('URL that JWT will be posted'),
      '#maxlength' => 255,
      '#default_value' => $config->get('jwt_config')['url_post']
    ];

    $form['field_configuration']['field_jwt_configuration']['url_post_timout'] = [
      '#type' => 'number',
      '#title' => $this->t('URL Post Timeout'),
      '#description' => $this->t('Ajax Timeout'),
      '#maxlength' => 255,
      '#default_value' => $config->get('jwt_config')['url_post_timout']
    ];

    $form['field_configuration']['field_jwt_configuration']['jwt_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('JWT Key'),
      '#description' => $this->t('Key for JWT'),
      '#size' => 255,
      '#default_value' => $config->get('jwt_config')['jwt_key']
    ];

    $form['field_configuration']['field_jwt_configuration']['validity_time'] = [
      '#type' => 'number',
      '#title' => $this->t('Validation Time (Seconds)'),
      '#description' => $this->t('Time of validity of JWT Token in seconds.'),
      '#maxlength' => 255,
      '#default_value' => $config->get('jwt_config')['validity_time']
    ];

    $form['field_configuration']['field_jwt_configuration']['xDomain_proxy'] = [
      '#type' => 'url',
      '#title' => $this->t('XDomain Proxy'),
      '#description' => $this->t(
        'The protocol and domain of the XDomain proxy for CORS support (eg. https://www.cs-livechatcom)'
      ),
      '#maxlength' => 255,
      '#default_value' => $config->get('jwt_config')['xDomain_proxy']
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save')
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'livechat_settings_form';
  }

  /**
   *
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.livechat_configuration'];
  }


  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $configuration = $form_state->getValue('field_configuration');
    $this->config('webcomposer_config.livechat_configuration')
      ->set('live_chat_text', $configuration['live_chat_text'])
      ->set('live_chat_link', $configuration['live_chat_link'])
      ->set('jwt_config.jwt_enabled', $configuration['field_jwt_configuration']['jwt_enabled'])
      ->set('jwt_config.url_post', $configuration['field_jwt_configuration']['url_post'])
      ->set('jwt_config.url_post_timout', $configuration['field_jwt_configuration']['url_post_timout'])
      ->set('jwt_config.jwt_key', $configuration['field_jwt_configuration']['jwt_key'])
      ->set('jwt_config.validity_time', $configuration['field_jwt_configuration']['validity_time'])
      ->set('jwt_config.xDomain_proxy', $configuration['field_jwt_configuration']['xDomain_proxy'])
      ->save();
  }
}
