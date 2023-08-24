<?php

namespace Drupal\msw_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_general_config_form",
 *   route = {
 *     "title" = "General Configuration",
 *     "path" = "/admin/config/msw/msw_general_configuration",
 *   },
 *   menu = {
 *     "title" = "General Configuration",
 *     "description" = "Provides General configuration for MSW",
 *     "parent" = "msw_config.list",
 *     "weight" = 11
 *   },
 * )
 */

class MSWGeneralConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['msw_config.general_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('General Configuration'),
    ];
    $this->mswHiddenTitle($form);
    $this->helpCenterConfig($form);

    return $form;
  }

  /**
   * {@inheritDoc}
   */
  private function mswHiddenTitle(array &$form) {
    $form['msw_hidden_title'] = [
      '#type' => 'details',
      '#title' => t('MSW SEO Hidden Title'),
      '#group' => 'advanced',
    ];

    $form['msw_hidden_title']['msw_hidden_title_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('MSW SEO Hidden title value'),
      '#default_value' => $this->get('msw_hidden_title_value'),
      '#description' => $this->t('Here we can add title that will be hidden under logo on header part'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritDoc}
   */
  private function helpCenterConfig(array &$form) {
    $form['help_center_setting'] = [
      '#type' => 'details',
      '#title' => t('Help Center Configuration'),
      '#group' => 'advanced',
    ];

    $form['help_center_setting']['help_center'] = [
      '#type' => 'details',
      '#title' => $this->t('Help Center'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['help_center_setting']['help_center']['enable_help_center'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Help Center'),
      '#default_value' => $this->get('enable_help_center'),
      '#translatable' => TRUE,
    ];

    $form['help_center_setting']['help_center']['help_center_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Help Center Title'),
      '#default_value' => $this->get('help_center_title'),
      '#translatable' => TRUE,
    ];
  }
}
