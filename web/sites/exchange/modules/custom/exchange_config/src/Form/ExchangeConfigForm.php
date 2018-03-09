<?php

namespace Drupal\exchange_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Configuration Form for exchange Configuration.
 */
class ExchangeConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['exchange_config.exchange_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'exchange_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('exchange_config.exchange_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Exchange Configurations'),
    ];

    $form['exchange_gen_config'] = [
      '#type' => 'details',
      '#title' => t('Exchange General Configurations'),
      '#group' => 'advanced',
    ];

    $form['exchange_gen_config']['file_image_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background'),
      '#default_value' => $config->get('file_image_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['trust_element'] = [
      '#type' => 'details',
      '#title' => t('Trust Element'),
      '#group' => 'advanced',
    ];

    $form['trust_element']['trust_element_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('trust_element_title'),
    ];

    $data = $config->get('trust_element_content');
    $form['trust_element']['trust_element_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $data['value'],
      '#format' => $data['format'],
    ];

    $form['lobby_tiles'] = [
      '#type' => 'details',
      '#title' => t('Lobby Tiles'),
      '#group' => 'advanced',
    ];

    $form['lobby_tiles']['lobby_tiles_alignment'] = [
      '#type' => 'select',
      '#title' => $this->t('Lobby Tiles Alignment'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('lobby_tiles_alignment'),
    ];

   $form['exchange_blocking_country'] = [
      '#type' => 'details',
      '#title' => t('Blocking Country'),
      '#group' => 'advanced',
    ];
    $form['exchange_blocking_country']['blocking_country_not_found_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('blocking_country_not_found_title'),
    ];

    $form['exchange_blocking_country']['file_image_country'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $config->get('file_image_country'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $exchange = $config->get('blocking_country_not_found_content');
    $form['exchange_blocking_country']['blocking_country_not_found_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $exchange['value'],
      '#format' => $exchange['format'],
    ];

     $form['exchange_blocking_currency'] = [
      '#type' => 'details',
      '#title' => t('Blocking Currency'),
      '#group' => 'advanced',
    ];
    $form['exchange_blocking_currency']['blocking_currency_not_found_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('blocking_currency_not_found_title'),
    ];

    $form['exchange_blocking_currency']['file_image_currency'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => $config->get('file_image_currency'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $exchangecurrency = $config->get('blocking_currency_not_found_content');
    $form['exchange_blocking_currency']['blocking_currency_not_found_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $exchangecurrency['value'],
      '#format' => $exchangecurrency['format'],
    ];



    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'trust_element_title',
      'trust_element_content',
      'lobby_tiles_alignment',
      'file_image_background',
      'blocking_country_not_found_title',
      'blocking_country_not_found_content',
      'file_image_country',
      'blocking_currency_not_found_title',
      'blocking_currency_not_found_content',
      'file_image_currency',
    ];
    foreach ($keys as $key) {
     $this->config('exchange_config.exchange_configuration')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
