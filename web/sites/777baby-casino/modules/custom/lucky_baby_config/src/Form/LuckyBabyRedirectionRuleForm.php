<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_redirection_rule",
 *   route = {
 *     "title" = "Redirection Rule Configuration",
 *     "path" = "/admin/config/lucky_baby/redirection_rule_configuration",
 *   },
 *   menu = {
 *     "title" = "Redirection Rule Configuration",
 *     "description" = "Provides redirection rule configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyRedirectionRuleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.lucky_baby_redirection_rule'];
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
