<?php

namespace Drupal\webcomposer_content_slider\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Announcement custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "content_slider_config_form",
 *   route = {
 *     "title" = "Web Composer Content Slider Configuration",
 *     "path" = "/admin/config/webcomposer/content_slider/config",
 *   },
 *   menu = {
 *     "title" = "Web Composer Content Slider Configuration",
 *     "description" = "Configure the content slider custom configuration",
 *     "parent" = "webcomposer_content_slider.admin_settings",
 *   },
 * )
 */
class ContentSliderConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.content_slider_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['ContentSliderConfig_settings']['content_slider_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Content Slider Title'),
        '#default_value' => $this->get('content_slider_title'),
        '#translatable'=> true
      ];
  
      $form['ContentSliderConfig_settings']['content_slider_close_btn_label'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Content Slider Close Button Label'),
        '#default_value' => $this->get('content_slider_close_btn_label'),
        '#translatable'=> true
      ];

    return $form;
  }
}
