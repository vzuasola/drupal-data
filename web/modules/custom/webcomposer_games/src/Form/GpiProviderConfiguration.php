<?php

namespace Drupal\webcomposer_games\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Gpi Game configuration class
 */
class GpiProviderConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  /**
   * Gpi Game Providers definitions
   */
    const gpi_GAME_PROVIDERS = [
        'gpi_keno' => 'GPI Keno',
        'gpi_pk10' => 'GPI PK10',
        'gpi_thai_lottey' => 'GPI Thai Lottey',
    ];
  public function getFormId() {
    return 'gpi_provider_settings_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.games_gpi_provider'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('webcomposer_config.games_gpi_provider');
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Gpi Configurations'),
    ];

    foreach (self::gpi_GAME_PROVIDERS as $key => $value) {
      $form[$key] = [
        '#type' => 'details',
        '#title' => t($value),
        '#group' => 'advanced',
      ];
      $form[$key]["{$key}_currency"] = [
        '#type' => 'textarea',
        '#title' => t('Supported Currencies'),
        '#description' => $this->t("Currency mapping for {$value}."),
        '#default_value' => $config->get("{$key}_currency")
      ];
      $form[$key]["{$key}_language_mapping"] = [
        '#type' => 'textarea',
        '#title' => t('Language Mapping'),
        '#description' => $this->t("Language mapping for {$value}."),
        '#default_value' => $config->get("{$key}_language_mapping")
      ];
    }


    $form['gpi_gen_config'] = [
      '#type' => 'details',
      '#title' => t('Gpi General Configurations'),
      '#group' => 'advanced',
    ];


    $form['gpi_gen_config']['gpi_game_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Gpi Game url'),
      '#description' => $this->t('Defines the  GPI  Game Url'),
      '#default_value' => $config->get('gpi_game_url')
    );
    $form['gpi_gen_config']['gpi_lottery_keno_version_no'] = array(
      '#type' => 'textfield',
      '#title' => t('Gpi Lottery Keno Version Number'),
      '#description' => $this->t('Defines the  GPI lottery Keno Version Number'),
      '#default_value' => $config->get('gpi_lottery_keno_version_no')
    );
    $form['gpi_gen_config']['gpi_vendor_id'] = array(
      '#type' => 'textfield',
      '#title' => t('Gpi  Vendor Id'),
      '#description' => $this->t('Defines the  GPI  Vendor Id'),
      '#default_value' => $config->get('gpi_vendor_id')
    );
    $form['actions'] = ['#type' => 'actions'];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save')
    ];

    return $form;
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $providers = [];
    foreach (self::gpi_GAME_PROVIDERS as $key => $value) {
      $providers[] = "{$key}_currency";
      $providers[] = "{$key}_language_mapping";
    }
    $keys = [
      'gpi_game_url',
      'gpi_lottery_keno_version_no',
      'gpi_vendor_id',
    ];
    $result = array_merge($providers, $keys);

    foreach ($result as $key) {
      $this->config('webcomposer_config.games_gpi_provider')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }
}
