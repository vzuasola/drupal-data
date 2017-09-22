<?php

namespace Drupal\keno_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Trust Element.
 */
class KenoConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['keno_config.keno_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'keno_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('keno_config.keno_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Keno Configurations'),
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

    $d = $config->get('trust_element_content');
    $form['trust_element']['trust_element_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
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
    $kenoConfig = [
      'trust_element_title',
      'trust_element_content',
      'lobby_tiles_alignment',
    ];
    foreach ($kenoConfig as $keys) {
        $this->config('keno_config.keno_configuration')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
