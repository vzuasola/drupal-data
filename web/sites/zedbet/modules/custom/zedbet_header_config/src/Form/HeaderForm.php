<?php

namespace Drupal\zedbet_header_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zedbet_header_config",
 *   route = {
 *     "title" = "Product Header Configuration",
 *     "path" = "/admin/config/zedbet/config/header",
 *   },
 *   menu = {
 *     "title" = "Product Header Configuration",
 *     "description" = "Provides product configuration for header components",
 *     "parent" = "zedbet_config.list",
 *   },
 * )
 */
class HeaderForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zedbet_header_config.header_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['header_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration Product Override'),
    ];

    $products = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('product');

    foreach ($products as $key => $value) {
      if ($value->name != 'entry') {
        $this->getFieldsTab($form[$key], $value->name);
      }
    }

    return $form;
  }

  private function getFieldsTab(&$form, $value) {
    $form = [
      '#type' => 'details',
      '#title' => ucfirst($this->t($value)),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab'
    ];

    $this->sectionLogo($form, $value);
    $this->sectionCashier($form, $value);
    $this->sectionBalance($form, $value);

    return $form;
  }

  /**
   *
   */
  private function sectionLogo(&$form, $value) {
    $form[$value . '_logo_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Logo'),
      '#collapsible' => TRUE,
    ];

    $form[$value . '_logo_group'][$value . '_logo_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logo Title'),
      '#description' => $this->t('The title attribute for the main logo.'),
      '#default_value' => $this->get($value . '_logo_title'),
      '#required' => FALSE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionCashier(&$form, $value) {
    $form[$value . '_cashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Cashier'),
      '#collapsible' => true,
    ];

    $form[$value . '_cashier_group'][$value . '_default_cashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Cashier Link'),
      '#description' => $this->t('Specify a default cashier link if no one matches the mapping'),
      '#default_value' => $this->get($value . '_default_cashier_link'),
      '#rows' => 1,
      '#required' => false,
      '#translatable' => true,
    ];

    $form[$value . '_cashier_group'][$value . '_cashier_mapping'] = [
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
      '#default_value' => $this->get($value . '_cashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionMcashier(&$form, $value) {
    $form[$value . '_mcashier_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Cashier'),
      '#collapsible' => true,
    ];

    $form[$value . '_mcashier_group'][$value . '_default_mcashier_link'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Default Mobile Cashier Link'),
      '#description' => $this->t('Specify a default Mobile cashier link if no one matches the mapping'),
      '#default_value' => $this->get($value . '_default_mcashier_link'),
      '#rows' => 1,
      '#required' => false,
      '#translatable' => true,
    ];

    $form[$value . '_mcashier_group'][$value . '_mcashier_link_target'] = [
      '#type' => 'select',
      '#options' => [
        '_self' => 'Same Tab',
        '_blank' => 'New Tab',
        'window' => 'New Window'
      ],
      '#title' => $this->t('Mobile Cashier Link Target'),
      '#description' => $this->t('Select a Mobile cashier link target'),
      '#default_value' => $this->get($value . '_mcashier_link_target'),
      '#rows' => 1,
      '#required' => false,
      '#translatable' => true,
    ];

    $form[$value . '_mcashier_group'][$value . '_mcashier_mapping'] = [
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
      '#default_value' => $this->get($value . '_mcashier_mapping'),
      '#rows' => 6,
      '#required' => false,
      '#translatable' => true,
    ];
  }

  /**
   *
   */
  private function sectionBalance(&$form, $value) {
    $form[$value . '_balance_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Balance'),
      '#collapsible' => TRUE,
    ];

    $form[$value . '_balance_group'][$value . '_balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Balance Mapping'),
      '#description' => $this->t('Provide a product mapping that will show up below the username'),
      '#default_value' => $this->get($value . '_balance_mapping'),
      '#translatable' => TRUE,
    ];
  }
}
