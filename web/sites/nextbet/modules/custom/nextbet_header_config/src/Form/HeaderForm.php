<?php

namespace Drupal\nextbet_header_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_header_config",
 *   route = {
 *     "title" = "Header Configuration",
 *     "path" = "/admin/config/nextbet/config/header",
 *   },
 *   menu = {
 *     "title" = "Header Configuration",
 *     "description" = "Provides configuration for header components",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class HeaderForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nextbet_header_config.header_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['header_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionProductTab($form);

    return $form;
  }

  /**
   *
   */
  private function sectionProductTab(array &$form) {
    $form['product_tab'] = [
      '#type' => 'select',
      '#title' => $this->t('Product'),
      '#default_value' => \Drupal::entityTypeManager()->getStorage('field_product')->loadMultiple(),
      '#required' => TRUE,
    ];

    $this->sectionLogo($form);
    $this->sectionCashier($form);
    $this->sectionBalance($form);
    $this->sectionOther($form);
  }

  /**
   *
   */
  private function sectionLogo(array &$form) {
    $form['logo_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Logo'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['logo_group']['logo_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logo Title'),
      '#description' => $this->t('The title attribute for the main logo.'),
      '#default_value' => $this->get('logo_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionCashier(array &$form) {
    $form['cashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Cashier'),
      '#collapsible' => true,
      '#group' => 'header_settings_tab',
    ];

    $form['cashier_group']['default_cashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Cashier Link'),
      '#description' => $this->t('Specify a default cashier link if no one matches the mapping'),
      '#default_value' => $this->get('default_cashier_link'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['cashier_group']['cashier_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cashier Mapping'),
      '#description' => $this->t("
        Define a cashier mapping based on the user's currency and registered country
        using the format.
        <br>
        Use upper case currency and country values (without spaces in between pipes).
        <br>
        <strong>currency | country | link</strong>
        <br><br>
        Example
        <br>
        CNY|CN|http://cashier.dafabet.com/
      "),
      '#default_value' => $this->get('cashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionMcashier(array &$form) {
    $form['mcashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Cashier'),
      '#collapsible' => true,
      '#group' => 'header_settings_tab',
    ];

    $form['mcashier_group']['default_mcashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Mobile Cashier Link'),
      '#description' => $this->t('Specify a default Mobile cashier link if no one matches the mapping'),
      '#default_value' => $this->get('default_mcashier_link'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['mcashier_group']['mcashier_link_target'] = [
      '#type' => 'select',
      '#options' => [
        '_self' => 'Same Tab',
        '_blank' => 'New Tab',
        'window' => 'New Window'
      ],
      '#title' => $this->t('Mobile Cashier Link Target'),
      '#description' => $this->t('Select a Mobile cashier link target'),
      '#default_value' => $this->get('mcashier_link_target'),
      '#rows' => 1,
      '#required' => true,
      '#translatable' => true,
    ];

    $form['mcashier_group']['mcashier_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mobile Cashier Mapping'),
      '#description' => $this->t("
        Define a Mobile cashier mapping based on the user's currency and registered country
        using the format.
        <br>
        Use upper case currency and country values (without spaces in between pipes).
        <br>
        <strong>currency | country | link</strong>
        <br><br>
        Example
        <br>
        CNY|CN|http://mcashier.dafabet.com/
      "),
      '#default_value' => $this->get('mcashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionBalance(array &$form) {
    $form['balance_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Balance'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['balance_group']['balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Balance Mapping'),
      '#description' => $this->t('Provide a product mapping that will show up below the username'),
      '#default_value' => $this->get('balance_mapping'),
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionOther(array &$form) {
    $form['header_other_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Others'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    ];

    $form['header_other_group']['lobby_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lobby Page Title.'),
      '#description' => $this->t('Lobby Page Title.'),
      '#default_value' => $this->get('lobby_page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
}
