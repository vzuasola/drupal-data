<?php

namespace Drupal\webcomposer_cdn\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactory;

/**
 * Class CDNConfigForm.
 *
 * @package Drupal\webcomposer_cdn\Form
 */
class CDNConfigForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_cdn.cdn_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cdn_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_cdn.cdn_configuration');

    $form['enable_cdn'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable CDN'),
      '#default_value' => $config->get('enable_cdn'),
      '#description' => $this->t('This will enable CDN functionality if checked'),
    ];
    $form['cdn_domain_configuration'] = [
      '#type' => 'textarea',
      '#title' => $this->t('CDN Domain Configuration'),
       '#default_value' => $config->get('cdn_domain_configuration'),
      '#description' => $this->t('Add the CDN domain to specific country here please follow the following format. &quot;Country Code | Domain&quot; Example: PH | example.cdn.com'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     $keys = array(
      'enable_cdn',
      'cdn_domain_configuration'
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_cdn.cdn_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);

  }

}
