<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_special_promotions_notif",
 *   route = {
 *     "title" = "Special Promotions Notification Configuration",
 *     "path" = "/admin/config/jamboree/special_promotions_notif_page_configuration",
 *   },
 *   menu = {
 *     "title" = "Special Promotions Notification Configuration",
 *     "description" = "Special Promotions Notification configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeSpecialPromotionsNotifConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.special_promotions_notif_page_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Special Promotions Notification Configuration'),
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
        '#title' => t('Special Promotions Notification'),
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
        '#title' => t('Next Label.'),
        '#default_value' => $this->get('sp_next'),
        '#translatable' => TRUE,
      ];
  }
}
