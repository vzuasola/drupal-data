<?php

namespace Drupal\mobile_sponsor_list_v2\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Mobile Sponsor custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_sponsor_config_form",
 *   route = {
 *     "title" = "Web Composer Mobile Sponsor Configuration",
 *     "path" = "/admin/config/mobile/mobile_sponsor_list_v2/config",
 *   },
 *   menu = {
 *     "title" = "Web Composer Mobile Sponsor Configuration",
 *     "description" = "Configure the Mobile Sponsor custom configuration",
 *     "parent" = "mobile_sponsor_list_v2.list",
 *   },
 * )
 */
class MobileSponsorListv2ConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.mobile_sponsor_list_v2'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['mobile_sponsor_list_v2_settings']['field_sponsor_title_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $this->get('field_sponsor_title_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['mobile_sponsor_list_v2_settings']['field_sponsor_subtitle_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $this->get('field_sponsor_subtitle_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];

    return $form;
  }
}
