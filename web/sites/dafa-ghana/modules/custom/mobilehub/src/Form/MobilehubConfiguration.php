<?php

namespace Drupal\mobilehub\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobilehub_config",
 *   route = {
 *     "title" = "Mobilehub Configuration",
 *     "path" = "/admin/mobilehub/config",
 *   },
 *   menu = {
 *     "title" = "Mobilehub Configuration",
 *     "description" = "Configure mobilehub",
 *     "parent" = "mobilehub.list",
 *     "weight" = 30
 *   },
 * )
 */
class MobilehubConfiguration extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobilehub.mobilehub_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->mobilehubSetting($form);

    return $form;
  }

  private function mobilehubSetting(array &$form) {
    $form['settings'] = [
      '#type' => 'details',
      '#title' => t('Mobilehub Configuration'),
      '#group' => 'advanced',
    ];

    $form['settings']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobilehub Page Title'),
      '#description' => $this->t('Adds Browser Tab Title on Mobilehub Page'),
      '#default_value' => $this->get('tab_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

  }
}
