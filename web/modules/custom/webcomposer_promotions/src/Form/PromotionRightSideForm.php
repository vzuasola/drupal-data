<?php

namespace Drupal\webcomposer_promotions\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class PromotionRightSideForm.
 *
 * @package Drupal\webcomposer_promotions\Form
 */
class PromotionRightSideForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'webcomposer_config.promotion_right_side',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'promotion_right_side_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.promotion_right_side');

    $form['promotion_right_side_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Right Side Title'),
      '#description' => $this->t('The title of the promotion right side block'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('promotion_right_side_title'),
    );

    $form['promotion_right_side_visibility'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Promotion Right Side Visibility'),
      '#description' => $this->t('Defines page were the promotion right side block will be visible'),
      '#default_value' => $config->get('promotion_right_side_visibility'),
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
      'promotion_right_side_title',
      'promotion_right_side_visibility',
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_config.promotion_right_side')->set($key, $form_state->getValue($key))->save();
    }
  }
}
