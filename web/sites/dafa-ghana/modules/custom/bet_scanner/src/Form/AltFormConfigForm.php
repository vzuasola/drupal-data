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
    $this->betHistoryConfig($form);

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

    $form['alternative_form_general_config']['enable_bet_scanner'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Bet Scanner - enable/disable'),
      '#default_value' => $this->get('enable_bet_scanner'),
      '#translatable' => TRUE,
    ];

    $form['alternative_form_general_config']['bet_scanner_configuration'] = [
      '#type' => 'details',
      '#title' => $this->t('Bet Scanner Configuration'),
    ];

    $form['alternative_form_general_config']['bet_scanner_configuration']['alternative_form_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t("Alternative Form Text"),
      '#default_value' => $this->get('alternative_form_text', 'Bet Scanner Alternative Text'),
      '#required' => FALSE,
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

    $content = $this->get('kbs_message');
    $form['alternative_form_integration_config']['kbs_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('KBS Statuses'),
      '#description' => $this->t('Please fill each status and its value in single row.'),
      '#default_value' => $content,
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   * Bet History Configuration.
   */
  private function betHistoryConfig(&$form) {
    $form['bet_history_config'] = [
      '#type' => 'details',
      '#title' => t("History"),
      '#group' => 'bet_scanner_group',
    ];

    $form['bet_history_config']['history_limit'] = [
      '#type' => 'textfield',
      '#title' => t('History Limit'),
      '#required' => TRUE,
      '#description' => $this->t('History Limit'),
      '#default_value' => $this->get('history_limit'),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['history_title'] = [
      '#type' => 'textfield',
      '#title' => t('History Title'),
      '#required' => TRUE,
      '#description' => $this->t('Bet Scanner History Title'),
      '#default_value' => $this->get('history_title', "Title"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['date_scanned_label'] = [
      '#type' => 'textfield',
      '#title' => t('Date Scanned Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Date Scanned column.'),
      '#default_value' => $this->get('date_scanned_label', "Date Scanned"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['product_label'] = [
      '#type' => 'textfield',
      '#title' => t('Product Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Product column.'),
      '#default_value' => $this->get('product_label', "Product"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['receipt_id_label'] = [
      '#type' => 'textfield',
      '#title' => t('Bet Receipt ID Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Bet Receipt ID column.'),
      '#default_value' => $this->get('receipt_id_label', "Bet Receipt ID"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['shop_name_label'] = [
      '#type' => 'textfield',
      '#title' => t('Shop Name Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Shop Name Column.'),
      '#default_value' => $this->get('shop_name_label', "Shop Name"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['scan_status_label'] = [
      '#type' => 'textfield',
      '#title' => t('Scan Status Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Scan Status column.'),
      '#default_value' => $this->get('scan_status_label', "Scan Status"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['nav_next_label'] = [
      '#type' => 'textfield',
      '#title' => t('Navigation Next Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Next Navigation button.'),
      '#default_value' => $this->get('nav_next_label', "Next"),
      '#translatable' => TRUE,
    ];

    $form['bet_history_config']['nav_previous_label'] = [
      '#type' => 'textfield',
      '#title' => t('Navigation Previous Label'),
      '#required' => TRUE,
      '#description' => $this->t('Label to be used in Previous navigation button.'),
      '#default_value' => $this->get('nav_previous_label', "Previous"),
      '#translatable' => TRUE,
    ];

    $content = $this->get('history_empty_message');
    $form['bet_history_config']['history_empty_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('History Empty Message'),
      '#default_value' => $content['value'],
      '#format' => $content['format'],
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

}
