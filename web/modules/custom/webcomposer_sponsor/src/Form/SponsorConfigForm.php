<?php

namespace Drupal\webcomposer_sponsor\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sponsor custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_sponsor_config_form",
 *   route = {
 *     "title" = "Sponsor Configuration",
 *     "path" = "/admin/config/webcomposer_sponsor/config",
 *   },
 *   menu = {
 *     "title" = "Sponsor Configuration",
 *     "description" = "Configure the Sponsor",
 *     "parent" = "webcomposer_sponsor.list",
 *   },
 * )
 */
class SponsorConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.webcomposer_sponsor'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['webcomposer_sponsor']['field_sponsor_text_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $this->get('field_sponsor_text_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px)",
    ];
    $form['webcomposer_sponsor']['field_sponsor_subtext_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $this->get('field_sponsor_subtext_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px)",
    ];

    return $form;
  }
}
