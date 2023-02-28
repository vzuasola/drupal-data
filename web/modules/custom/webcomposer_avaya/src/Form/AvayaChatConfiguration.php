<?php

namespace Drupal\webcomposer_avaya\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "avaya_configuration",
 *   route = {
 *     "title" = "Avaya Chat Configuration",
 *     "path" = "/admin/config/webcomposer/config/avaya",
 *   },
 *   menu = {
 *     "title" = "Avaya Chat Configuration",
 *     "description" = "Provides Webcomposer Avaya Chat configuration",
 *     "parent" = "webcomposer_avaya.list",
 *     "weight" = 30
 *   },
 * )
 */
class AvayaChatConfiguration extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.avaya_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['avaya'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#group' => 'avaya',
      '#type' => 'details',
      '#title' => 'Global Configuration',
    ];

    $form['header_configuration'] = [
      '#group' => 'avaya',
      '#type' => 'details',
      '#title' => 'Field Configuration',
    ];

    $form['field_configuration']['base_url'] = [
      '#rows' => 3,
      '#type' => 'textarea',
      '#title' => $this->t('Avaya Chat Base URL'),
      '#default_value' => $this->get('base_url'),
      '#description' => $this->t('Link for Live Chat.'),
      '#translatable' => TRUE,
    ];

    $form['field_configuration']['url_post'] = [
      '#rows' => 1,
      '#type' => 'textarea',
      '#title' => $this->t('URL Post'),
      '#default_value' => $this->get('url_post'),
      '#description' => $this->t('Avaya API url'),
    ];

    $form['field_configuration']['url_post_timout'] = [
      '#type' => 'number',
      '#maxlength' => 255,
      '#title' => $this->t('URL Post Timeout'),
      '#description' => $this->t('Ajax Timeout'),
      '#default_value' => $this->get('url_post_timout'),
    ];

    $form['field_configuration']['jwt_key'] = [
      '#size' => 255,
      '#type' => 'textfield',
      '#title' => $this->t('JWT Key'),
      '#description' => $this->t('Key for JWT'),
      '#default_value' => $this->get('jwt_key'),
    ];

    $form['field_configuration']['validity_time'] = [
      '#type' => 'number',
      '#maxlength' => 255,
      '#default_value' => $this->get('validity_time'),
      '#title' => $this->t('Validation Time (Seconds)'),
      '#description' => $this->t('Time of validity of JWT Token in seconds.'),
    ];

    $form['field_configuration']['xdomain_proxy'] = [
      '#rows' => 1,
      '#type' => 'textarea',
      '#title' => $this->t('XDomain Proxy'),
      '#description' => $this->t(
        'The protocol and domain of the XDomain proxy for CORS support ' .
        ' (eg. https://www.cs-livechat.com)'
      ),
      '#default_value' => $this->get('xdomain_proxy'),
    ];

    $form['field_configuration']['web_rtc_url'] = [
      '#rows' => 1,
      '#type' => 'textarea',
      '#title' => $this->t('Webrtc Url'),
      '#description' => $this->t(
        'The protocol and domain of the Webrtc Url ' .
        ' (eg. www.cs-livechat.com/ccaas/v1/call)'
      ),
      '#default_value' => $this->get('web_rtc_url'),
    ];

    $form['header_configuration']['livechat_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Text'),
      '#description' => $this->t('Text that will be displayed inside the chatbox'),
      '#default_value' => $this->get('livechat_text'),
      '#translatable' => TRUE,
      '#maxlength' => 500,
    ];

    return $form;
  }

}
