<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_special_promotions_notif",
 *   route = {
 *     "title" = "Special Promotions Notif Configuration",
 *     "path" = "/admin/config/zipang/special_promotions_notif_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Special Promotions Notif Configuration",
 *     "description" = "Provides Special Promotions Notif configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangSpecialPromotionsNotifConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.special_promotions_notif_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Special Promotion Notif Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {
    $form['sp_notif'] = [
        '#type' => 'details',
        '#title' => t('Special Promotions Notif'),
        '#group' => 'advanced',
      ];

    $form['sp_notif']['checkbox_textfield'] = [
        '#type' => 'textfield',
        '#title' => t('Checkbox Textfield.'),
        '#default_value' => $this->get('checkbox_textfield'),
        '#translatable' => TRUE,
      ];

    $form['sp_notif']['sp_prev'] = [
        '#type' => 'textfield',
        '#title' => t('Previous Label.'),
        '#default_value' => $this->get('sp_prev'),
        '#translatable' => TRUE,
      ];

    $form['sp_notif']['sp_next'] = [
        '#type' => 'textfield',
        '#title' => t('Right Label.'),
        '#default_value' => $this->get('sp_next'),
        '#translatable' => TRUE,
      ];
  }
}
