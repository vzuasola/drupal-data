<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_general_seo",
 *   route = {
 *     "title" = "Lucky Baby General SEO Configuration",
 *     "path" = "/admin/config/lucky_baby/general_seo",
 *   },
 *   menu = {
 *     "title" = "Lucky Baby General SEO Configuration",
 *     "description" = "Provides General SEO Configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyGeneralSEOConfig extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.general_seo'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('777Baby General SEO Configuration'),
    ];

    $this->sectionGeneralSEOSetting($form);

    return $form;
  }

  private function sectionGeneralSEOSetting(array &$form) {
    $form['general_seo_setting'] = [
      '#type' => 'details',
      '#title' => t('SEO canonical and hreflang Configuration'),
      '#group' => 'advanced',
    ];

    $canonical = $this->get('canonical_url');
    $form['general_seo_setting']['canonical_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Canonical URL'),
      '#default_value' => $canonical,
      '#required' => true,
      '#translatable' => false,
    ];

    $alternate = $this->get('alternate_url');
    $form['general_seo_setting']['alternate_url'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Hreflang alternate URL'),
      '#default_value' => $alternate,
      '#format' => $alternate['format'],
      '#description' => 'Define the hreflang mapping for alternate URL. Pipe seperated URL and hreflang per line.',
      '#required' => true,
      '#translatable' => false,
    ];
  }
}
