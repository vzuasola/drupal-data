<?php

namespace Drupal\webcomposer_config_schema_sample\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\webcomposer_config_schema\Plugin\WebcomposerConfigPluginInterface;

/**
 * Promotion plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "sample",
 *   route = {
 *     "title" = "Sample Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/sample",
 *   },
 *   menu = {
 *     "title" = "Sample Configuration",
 *     "description" = "Provides sample configuration",
 *     "parent" = "webcomposer_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class SampleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.sample'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['sample_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sample Text'),
      '#default_value' => $this->get('sample_text'),
      '#translate' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'sample_text',
    ];

    foreach ($keys as $key) {
      $this->save($key, $form_state->getValue($key));
    }

    return parent::submitForm($form, $form_state);
  }
}
