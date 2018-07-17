<?php

namespace Drupal\arcade_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class ArcadeConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['games_config.arcade_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'games_config.arcade_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('games_config.arcade_configuration');

    $form['arcade_configuration_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->arcadeCategorySetting($form, $config);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $keys = array(
      'arcade_category_switch'
    );

    foreach ($keys as $key) {
      $this->config('games_config.arcade_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

  private function arcadeCategorySetting(&$form, $config) {
    $form['category_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Arcade Category Settings'),
      '#collapsible' => TRUE,
      '#group' => 'arcade_configuration_tab',
    );

    $form['category_group']['arcade_category_switch'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Arcade Categories'),
      '#description' => $this->t('If disabled all games will be shown at once and categories will not be displayed.'),
      '#default_value' => $config->get('arcade_category_switch'),
      '#required' => FALSE,
    );
  }
}
