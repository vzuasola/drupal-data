<?php

namespace Drupal\zedbet_footer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Footer configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zedbet_footer_config",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/zedbet/config/footer",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides configuration for footer components",
 *     "parent" = "zedbet_config.list",
 *   },
 * )
 */
class FooterForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zedbet_footer_config.footer_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Footer Configuration'),
    ];

    $this->sectionInformation($form);
    $this->sectionHelpCenter($form);
    $this->sectionPayments($form);
    $this->sectionPartners($form);

    return $form;
  }

  /**
   *
   */
  private function sectionInformation(array &$form) {

    $form['information_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Information'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['information_group']['information_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Information Title'),
      '#description' => $this->t('Text to be displayed in information title.'),
      '#default_value' => $this->get('information_title') ?? 'Information',
      '#required' => TRUE,
      '#translatable' => TRUE,

    ];
  }

  /**
   *
   */
  private function sectionHelpCenter(array &$form) {

    $form['help_center_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Help Center'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['help_center_group']['help_center_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Help Center Title'),
      '#description' => $this->t('Text to be displayed in help center title.'),
      '#default_value' => $this->get('help_center_title') ?? 'Help Center',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionPayments(array &$form) {

    $form['payments_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Payments'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['payments_group']['payments_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Payments Title'),
      '#description' => $this->t('Text to be displayed in payment title.'),
      '#default_value' => $this->get('payments_title') ?? 'Payments',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionPartners(array &$form) {

    $form['partners_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Partners'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];

    $form['partners_group']['partners_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Official Partner Title'),
      '#description' => $this->t('Text to be displayed in partner title.'),
      '#default_value' => $this->get('partners_title') ?? 'Official Partner of',
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
}
