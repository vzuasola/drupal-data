<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for the Promotions Right Side Block.
 */
class PromotionsRightBlockConfig extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['casino_config.promo_right_block'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'promo_right_block_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $config = $this->config('casino_config.promo_right_block');
    $form['promo_block_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Panel Title'),
      '#description' => $this->t('Title of the Promotion Panel'),
      '#default_value' => $config->get('promo_block_title'),
    ];

    $form['promo_block_visibility'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Page Visibility for Block'),
      '#description' => $this->t('Specify pages by using their paths separated by comma. (e.g. /node/1, /node/2)'),
      '#default_value' => $config->get('promo_block_visibility'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $loginValuesKeys = [
      'promo_block_title',
      'promo_block_visibility',
    ];
    foreach ($loginValuesKeys as $keys) {
      $this->config('casino_config.promo_right_block')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
