<?php

namespace Drupal\mobile_casino\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_casino",
 *   route = {
 *     "title" = "Mobile Casino Configuration",
 *     "path" = "/admin/config/mobile/casino/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Casino Configuration",
 *     "description" = "Provides configuration for Casino",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileCasinoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_casino.casino_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['casino_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Casino Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['casino_configuration']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $form['casino_configuration']['casino_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Casino URL'),
      '#default_value' => $this->get('casino_url'),
    ];

    $form['casino_configuration']['casino_gold_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Casino Gold URL'),
      '#default_value' => $this->get('casino_gold_url'),
    ];

    return $form;
  }
}
