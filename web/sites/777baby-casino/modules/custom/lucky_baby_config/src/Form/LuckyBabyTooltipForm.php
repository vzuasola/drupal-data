<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_config",
 *   route = {
 *     "title" = "Tooltip Configuration",
 *     "path" = "/admin/config/777baby/tooltip_configuration",
 *   },
 *   menu = {
 *     "title" = "Tooltip Configuration",
 *     "description" = "Provides tooltip configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyTooltipForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.tooltip_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Lucky Baby Configurations'),
    ];

    $this->sectionTooltip($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionTooltip(array &$form) {
    $form['tooltip'] = [
      '#type' => 'details',
      '#title' => $this->t('Tooltip'),
    ];


    $default_tooltip_title = $this->get('tooltip_title');
    $form['tooltip']['tooltip_title'] = [
      '#type' => 'textfield',
      '#title' => t('Tooltip Title'),
      '#default_value' => $default_tooltip_title,
      '#description' => $this->t('Tooltip title'),
      '#translatable' => TRUE,
    ];

    $default_tooltip_summary = $this->get('tooltip_summary');
    $form['tooltip']['tooltip_summary'] = [
      '#type' => 'textfield',
      '#title' => t('Tooltip Summary'),
      '#default_value' => $default_tooltip_summary,
      '#description' => $this->t('Tooltip summary'),
      '#translatable' => TRUE,
    ];

    $default_tooltip_checkbox_text = $this->get('tooltip_checkbox_text');
    $form['tooltip']['tooltip_checkbox_text'] = [
      '#type' => 'textfield',
      '#title' => t('Tooltip Checkbox Text'),
      '#default_value' => $default_tooltip_checkbox_text,
      '#description' => $this->t('Tooltip checkbox text'),
      '#translatable' => TRUE,
    ];

  }
}
