<?php

namespace Drupal\entrypage_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class EntrypageCustomConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['entrypage_config.entrypage_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entrypage_config.entrypage_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('entrypage_config.entrypage_configuration');

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Entrypage Configuration'),
    );

    $form['trust_element'] = array(
      '#type' => 'details',
      '#title' => t('Trust Element'),
      '#group' => 'advanced',
    );

    $form['faqs_configuration'] = array(
      '#type' => 'details',
      '#title' => t('FAQ Configuration'),
      '#group' => 'advanced',
    );

    $config_tec= $config->get('trust_element_content');
    $form['trust_element']['trust_element_content'] = array(
        '#type' => 'text_format',
        '#title' => $this->t('Content'),
        '#default_value' => $config_tec['value'],
        '#format' => $config_tec['format']
    );

    $form['faqs_configuration']['faq_url'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Faq page URL'),
        '#default_value' => $config->get('faq_url'),
        '#translatable' => false,
    );

    $form['feature_flags_configuration'] = array(
      '#type' => 'details',
      '#title' => t('Feature Flags Configuration'),
      '#group' => 'advanced',
    );
    $form['feature_flags_configuration']['front_blocks'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Front Blocks V2'),
      '#default_value' => $config->get('front_blocks'),
      '#translatable' => true,
    );

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
    $keys = [
      'trust_element_content',
      'faq_url',
      'front_blocks'
    ];

    foreach ($keys as $key) {
      $this->config('entrypage_config.entrypage_configuration')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

}
