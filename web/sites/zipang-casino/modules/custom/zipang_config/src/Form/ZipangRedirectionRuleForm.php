<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_redirection_rule",
 *   route = {
 *     "title" = "Redirection Rule Configuration",
 *     "path" = "/admin/config/zipang/redirection_rule_configuration",
 *   },
 *   menu = {
 *     "title" = "Redirection Rule Configuration",
 *     "description" = "Provides redirection rule configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangRedirectionRuleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.zipang_redirection_rule'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Redirection Rule Configuration'),
    ];

    $this->sectionPageSetting($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPageSetting(array &$form) {

    $form['page_setting'] = [
        '#type' => 'details',
        '#title' => t('Redirection Rule Setting'),
        '#group' => 'advanced',
      ];

    $d = $this->get('redirection_urls');
    $form['page_setting']['redirection_urls'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Redirection URLS'),
      '#default_value' => $d,
      '#format' => $d['format'],
      '#description' => 'Pipe seperated URL and Redirects to per line. Ex. "jp/about-us|about-us" ',
      '#translatable' => TRUE,
    ];
  }
}
