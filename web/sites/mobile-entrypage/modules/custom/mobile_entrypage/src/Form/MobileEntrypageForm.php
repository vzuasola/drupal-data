<?php

namespace Drupal\mobile_entrypage\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_entrypage",
 *   route = {
 *     "title" = "Mobile Entrypage Configuration",
 *     "path" = "/admin/config/mobile/entrypage/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Entrypage Configuration",
 *     "description" = "Provides configuration for Entrypage",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileEntrypageForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_entrypage.entrypage_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['entrypage_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Entrypage Configuration'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['entrypage_configuration']['all_apps_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View All Apps Here'),
      '#default_value' => $this->get('all_apps_text'),
      '#translatable' => TRUE,
    ];

    $form['entrypage_configuration']['view_less_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View Less Here'),
      '#default_value' => $this->get('view_less_text'),
      '#translatable' => true,
    ];

    return $form;
  }
}
