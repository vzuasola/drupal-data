<?php

namespace Drupal\nextbet_footer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Footer configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "nextbet_footer_config",
 *   route = {
 *     "title" = "Footer Configuration",
 *     "path" = "/admin/config/nextbet/config/footer",
 *   },
 *   menu = {
 *     "title" = "Footer Configuration",
 *     "description" = "Provides configuration for footer components",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class FooterForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nextbet_footer_config.footer_configuration'];
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
    $config = $this->config('nextbet_footer_config.footer_configuration');

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
      '#default_value' => $config->get('information_title'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionHelpCenter(array &$form) {
    $config = $this->config('nextbet_footer_config.footer_configuration');

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
      '#default_value' => $config->get('help_center_title'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionPayments(array &$form) {
    $config = $this->config('nextbet_footer_config.footer_configuration');

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
      '#default_value' => $config->get('payments_title'),
      '#required' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionPartners(array &$form) {
    $config = $this->config('nextbet_footer_config.footer_configuration');

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
      '#default_value' => $config->get('partners_title'),
      '#required' => TRUE,
    ];
  }
}
