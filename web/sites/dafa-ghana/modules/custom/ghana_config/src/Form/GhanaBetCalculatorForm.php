<?php

namespace Drupal\ghana_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "ghana_betcalculator_config_form",
 *   route = {
 *     "title" = "Bet Calculator Configuration",
 *     "path" = "/admin/config/ghana/betcalculator_configuration",
 *   },
 *   menu = {
 *     "title" = "Bet Calculator Configuration",
 *     "description" = "Provides Bet Calculator configuration",
 *     "parent" = "ghana_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class GhanaBetCalculatorForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ghana_config.betcalculator_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['bet_calculator'] = [
      '#type' => 'details',
      '#title' => $this->t('Bet Calculator Iframe'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['bet_calculator']['bet_calculator_iframe_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Bet Calculator Iframe URL'),
      '#default_value' => $this->get('bet_calculator_iframe_url'),
      '#translatable' => FALSE,
    ];

    return $form;
  }
}
