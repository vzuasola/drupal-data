<?php

namespace Drupal\webcomposer_sponsor_responsive\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sponsor custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_sponsor_responsive_config_form",
 *   route = {
 *     "title" = "Responsive Sponsor Configuration",
 *     "path" = "/admin/config/webcomposer_sponsor_responsive/config",
 *   },
 *   menu = {
 *     "title" = "Responsive Sponsor Configuration",
 *     "description" = "Configure the Responsive Sponsor",
 *     "parent" = "webcomposer_sponsor_responsive.list",
 *   },
 * )
 */
class SponsorResponsiveConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.webcomposer_sponsor_responsive'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['webcomposer_sponsor_responsive']['field_mobile_sponsor_text_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $this->get('field_mobile_sponsor_text_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['webcomposer_sponsor_responsive']['field_mobile_sponsor_subtext_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $this->get('field_mobile_sponsor_subtext_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];

    return $form;
  }
}
