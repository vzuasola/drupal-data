<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_pt_configuration",
 *   route = {
 *     "title" = "LuckyBaby Playtech Configuration",
 *     "path" = "/admin/config/lucky_baby/playtech_configuration",
 *   },
 *   menu = {
 *     "title" = "LuckyBaby Playtech Configuration",
 *     "description" = "Provides registration configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyPlaytechForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.lucky_baby_pt_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('LuckyBaby Playtech Configuration'),
    ];

    $this->sectionPlaytechSettings($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPlaytechSettings(array &$form) {
    $form['pt_settings'] = [
      '#type' => 'details',
      '#title' => t('Playtech Settings'),
      '#group' => 'advanced',
    ];
    $form['pt_settings']['pt_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech API Hostname'),
      '#default_value' => $this->get('pt_host'),
    ];
    $form['pt_settings']['casino_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Name'),
      '#default_value' => $this->get('casino_name'),
    ];

    $form['pt_settings']['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Secret Key'),
      '#default_value' => $this->get('secret_key'),
    ];

    $form['pt_settings']['balance_currency_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Balance Currency Mapping'),
      '#default_value' => $this->get('balance_currency_mapping'),
    ];

    $form['pt_settings']['balance_error'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Balance Error Message'),
      '#default_value' => $this->get('balance_error'),
    ];
  }
}
