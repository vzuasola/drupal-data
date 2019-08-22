<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_press_config",
 *   route = {
 *     "title" = "Press Config Page Configuration",
 *     "path" = "/admin/config/jamboree/press_config_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Press Config Page Configuration",
 *     "description" = "Provides press config page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreePressConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.press_config_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Press Config Page Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['page_setting'] = [
      '#type' => 'details',
      '#title' => t('Press Config Page Setting'),
      '#group' => 'advanced',
    ];

    $d = $this->get('page_description');
    $form['page_setting']['page_description'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Page Description'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['page_setting']['error_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('No Result Message'),
      '#default_value' => $this->get('error_message'),
      '#translatable' => TRUE,
    ];
  }
}
