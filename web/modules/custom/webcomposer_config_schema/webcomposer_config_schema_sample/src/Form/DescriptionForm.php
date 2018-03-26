<?php

namespace Drupal\webcomposer_config_schema_sample\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_schema_sample_description",
 *   route = {
 *     "title" = "Description Form Configuration",
 *     "path" = "/admin/config/webcomposer/config/description",
 *   },
 *   menu = {
 *     "title" = "Description Configuration",
 *     "description" = "Provides sample configuration",
 *     "parent" = "webcomposer_config_schema_sample.list",
 *     "weight" = 30
 *   },
 * )
 */
class DescriptionForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config_schema_sample.description'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->get('description'),
      '#translatable' => TRUE,
    ];

    $form['another_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Another Description'),
      '#default_value' => $this->get('another_description'),
      '#translatable' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'description',
      'another_description',
    ];

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}
