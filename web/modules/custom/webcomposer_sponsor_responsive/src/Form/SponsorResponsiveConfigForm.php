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
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Sponsor Configuration'),
    ];
    $this->mobileFont($form);
    $this->desktopFont($form);

    return $form;
  }

  private function mobileFont(array &$form)
  {
    $form['mobile_font_details'] = [
      '#type' => 'details',
      '#title' => t('Mobile'),
      '#group' => 'advanced',
    ];
    $form['mobile_font_details']['field_mobile_sponsor_text_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $this->get('field_mobile_sponsor_text_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['mobile_font_details']['field_mobile_sponsor_subtext_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $this->get('field_mobile_sponsor_subtext_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
  }

  private function desktopFont(array &$form)
  {
    $form['desktop_font_details'] = [
      '#type' => 'details',
      '#title' => t('Desktop'),
      '#group' => 'advanced',
    ];
    $form['desktop_font_details']['field_desktop_sponsor_text_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Sponsor Title'),
      '#default_value' => $this->get('field_desktop_sponsor_text_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
    $form['desktop_font_details']['field_desktop_sponsor_subtext_font_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Font Size - Subtitle'),
      '#default_value' => $this->get('field_desktop_sponsor_subtext_font_size'),
      '#translatable' => TRUE,
      '#description' => "font size should be like e.g (12px or 1.2rem)",
    ];
  }
}
