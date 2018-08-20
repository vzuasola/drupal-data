<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_big_winner",
 *   route = {
 *     "title" = "Big Winner Page Configuration",
 *     "path" = "/admin/config/jamboree/big_winner_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Big Winner Page Configuration",
 *     "description" = "Provides big winner page configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeBigWinnerForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.big_winner_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Big Winner Page Configuration'),
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
      '#title' => t('Big Winner Page Setting'),
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

    $form['page_setting']['read_more_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Read More Text'),
      '#default_value' => $this->get('read_more_text'),
      '#translatable' => TRUE,
    ];

    $c = $this->get('custom_block');
    $form['page_setting']['custom_block'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Custom Block'),
      '#default_value' => $c['value'],
      '#format' => $c['format'],
      '#translatable' => TRUE,
    ];
  }
}
