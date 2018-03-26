<?php

namespace Drupal\webcomposer_config_schema_sample\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sample form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_schema_sample_sample",
 *   route = {
 *     "title" = "Sample Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/sample",
 *   },
 *   menu = {
 *     "title" = "Sample Configuration",
 *     "description" = "Provides sample configuration",
 *     "parent" = "webcomposer_config_schema_sample.list",
 *     "weight" = 30
 *   },
 * )
 */
class SampleForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config_schema_sample.sample'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['teaser'] = [
      '#type' => 'details',
      '#title' => $this->t('Teaser'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['teaser']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
    ];

    $form['teaser']['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->get('description'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
      'description',
    ];

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}
