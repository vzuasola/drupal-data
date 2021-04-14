<?php

namespace Drupal\bet_scanner\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Bet Scanner COnfiguration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "alternative_form_config",
 *   route = {
 *     "title" = "Bet Scanner Configuration",
 *     "path" = "/admin/config/bet-scanner/alt-form",
 *   },
 *   menu = {
 *     "title" = "Bet Scanner Configuration",
 *     "description" = "Bet Scanner Configuration",
 *     "parent" = "bet_scanner.list",
 *   },
 * )
 */
class AltFormConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['bet_scanner.alternative_form'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['bet_scanner_group'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->generalConfig($form);
    $this->integrationConfig($form);

    return $form;
  }

  /**
   * General Configuration for can't login.
   */
  private function generalConfig(&$form) {

    $form['alternative_form_general_config'] = [
      '#type' => 'details',
      '#title' => t("General Configuration"),
      '#group' => 'bet_scanner_group',
    ];

    $form['alternative_form_general_config']['bet_scanner_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Bet Scanner Configuration'),
    ];

    $form['alternative_form_general_config']['bet_scanner_configuration']['alternative_form_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Alternative Form Text"),
      '#default_value' => $this->get('alternative_form_text', 'Bet Scanner Alternative Text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['alternative_form_general_config']['bet_scanner_configuration']['page_header_bet_scanner_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Title"),
      '#default_value' => $this->get('page_header_bet_scanner_title', 'Bet Scanner Title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $body_content = $this->get('page_content');
    $form['alternative_form_general_config']['bet_scanner_configuration']['page_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content Blurb'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];

    $form['alternative_form_general_config']['alternative_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Alternative Bet Scanner Configuration'),
    ];

    $form['alternative_form_general_config']['alternative_configuration']['page_header_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Page Header Title"),
      '#default_value' => $this->get('page_header_title', 'Bet Scanner Title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Integration Configuration.
   */
  private function integrationConfig(&$form) {
    $form['alternative_form_integration_config'] = [
      '#type' => 'details',
      '#title' => t("Integration"),
      '#group' => 'bet_scanner_group',
    ];

    $form['alternative_form_integration_config']['kbs_end_point'] = [
      '#type' => 'textfield',
      '#title' => t('KBS Endpoint URL'),
      '#required' => TRUE,
      '#description' => $this->t('KBS End point'),
      '#default_value' => $this->get('kbs_end_point', "#"),
      '#translatable' => TRUE,
    ];

    $form['alternative_form_integration_config']['kbs_api_key'] = [
      '#type' => 'textfield',
      '#title' => t('KBS API key'),
      '#required' => TRUE,
      '#description' => $this->t('KBS API key'),
      '#default_value' => $this->get('kbs_api_key'),
      '#translatable' => TRUE,
    ];

    $content = $this->get('alt_form_success_message');
    $form['alternative_form_integration_config']['alt_form_success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Alternative Form Success Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $content = $this->get('alt_form_error_message');
    $form['alternative_form_integration_config']['alt_form_error_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Alternative Form Error Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}
