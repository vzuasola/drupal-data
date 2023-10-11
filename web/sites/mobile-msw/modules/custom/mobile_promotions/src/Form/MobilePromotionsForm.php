<?php

namespace Drupal\mobile_promotions\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Mobile Promotion Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_promotions",
 *   route = {
 *     "title" = "Mobile Promotions Configuration",
 *     "path" = "/admin/config/mobile_promotions/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Promotions Configuration",
 *     "description" = "Provides configuration for Promotions",
 *     "parent" = "mobile_promotions.list",
 *   },
 * )
 */
class MobilePromotionsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_promotions.promotions_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['promotions_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Promotions Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['promotions_configuration']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['promotions_configuration']['no_available_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No available promotions message'),
      '#default_value' => $this->get('no_available_msg'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    return $form;
  }
}
