<?php

namespace Drupal\webcomposer_promotions\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PromotionConfigurationForm.
 *
 * @package Drupal\webcomposer_promotions\Form
 */
class PromotionConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_config.promotion_configuration',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_promotions.promotion_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.promotion_configuration');

    $form['read_more'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Read More Text'),
      '#description' => $this->t('The Translated string for read more.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('read_more'),
    );

    $form['countdown'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Add Countdown Format'),
      '#description' => $this->t('The Translated string for countdown Format. eg: days, hours, remaining'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('countdown'),
    );

    $form['all_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Product Filter All Text'),
      '#description' => $this->t('The Translated string for the `All` text on the product filter dropdown'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('all_text'),
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
    parent::submitForm($form, $form_state);

    $keys = array(
      'read_more',
      'countdown',
      'all_text',
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_config.promotion_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }
}
