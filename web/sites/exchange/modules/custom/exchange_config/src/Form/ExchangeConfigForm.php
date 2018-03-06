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
      '#title' => t('exchange General Configurations'),
      '#group' => 'advanced',
    ];

    $form['exchange_gen_config']['exchange_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background'),
      '#default_value' => $config->get('exchange_background'),
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


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $exchangeConfig = [
      'trust_element_title',
      'trust_element_content',
      'lobby_tiles_alignment',
      'exchange_background',
    ];
    foreach ($exchangeConfig as $keys) {
      if ($keys == 'exchange_background') {
        $fid = $form_state->getValue('exchange_background');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'exchange_config', 'image', $fid[0]);

          $this->config('exchange_config.exchange_configuration')->set("exchange_background_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('exchange_config.exchange_configuration')->set("exchange_background_image_url", null);
        }
      }
      $this->config('exchange_config.exchange_configuration')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
