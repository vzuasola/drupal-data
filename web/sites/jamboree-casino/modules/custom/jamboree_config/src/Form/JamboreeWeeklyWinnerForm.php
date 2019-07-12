<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_weekly_winner",
 *   route = {
 *     "title" = "Weekly Winner Page Configuration",
 *     "path" = "/admin/config/jamboree/weekly_winner_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Weekly Winner Page Configuration",
 *     "description" = "Provides weekly winner page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeWeeklyWinnerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.weekly_winner_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Weekly Winner Page Configuration'),
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
      '#title' => t('Weekly Winner Page Setting'),
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

    $form['page_setting']['category_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Category Text'),
      '#default_value' => $this->get('category_text'),
      '#translatable' => TRUE,
    ];

    $e = $this->get('error_message');
    $form['page_setting']['error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Error Message'),
      '#default_value' => $e['value'],
      '#format' => $e['format'],
      '#translatable' => TRUE,
    ];
  }
}
