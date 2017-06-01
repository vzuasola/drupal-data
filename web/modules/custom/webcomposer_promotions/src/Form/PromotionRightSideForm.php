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
      'webcomposer_promotions.promotionrightside',
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
    $config = $this->config('webcomposer_promotions.promotionrightside');
    $form['promotion_right_side_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Right Side Title'),
      '#description' => $this->t('The title of the promotion right side block'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('promotion_right_side_title'),
    ];
    $form['promotion_right_side_visibility'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Promotion Right Side Visibility'),
      '#description' => $this->t('Defines page were the promotion right side block will be visible'),
      '#default_value' => $config->get('promotion_right_side_visibility'),
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
    parent::submitForm($form, $form_state);

    $this->config('webcomposer_promotions.promotionrightside')
      ->set('promotion_right_side_title', $form_state->getValue('promotion_right_side_title'))
      ->set('promotion_right_side_visibility', $form_state->getValue('promotion_right_side_visibility'))
      ->save();
  }

}
