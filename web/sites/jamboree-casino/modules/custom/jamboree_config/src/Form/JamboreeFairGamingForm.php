<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_fair_gaming",
 *   route = {
 *     "title" = "Fair Gaming Configuration",
 *     "path" = "/admin/config/jamboree/fair_gaming_configuration",
 *   },
 *   menu = {
 *     "title" = "Fair Gaming Configuration",
 *     "description" = "Provides fair gamimg configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeFairGamingForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.fair_gaming_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Fair Gaming Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['fair_gaming_setting'] = [
      '#type' => 'details',
      '#title' => t('Fair Gaming Page Setting'),
      '#group' => 'advanced',
    ];

    $form['fair_gaming_setting']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $form['fair_gaming_setting']['summary_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Summary Text'),
      '#default_value' => $this->get('summary_text'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('page_description');
    $form['fair_gaming_setting']['page_description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['fair_gaming_setting']['report_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Report Text'),
      '#default_value' => $this->get('report_text'),
      '#translatable' => TRUE,
    ];
  }
}
