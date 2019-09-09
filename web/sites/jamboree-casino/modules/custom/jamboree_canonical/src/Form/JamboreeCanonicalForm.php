<?php

namespace Drupal\jamboree_canonical\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_canonical",
 *   route = {
 *     "title" = "Jamboree Canonical Configuration",
 *     "path" = "/admin/config/jamboree/canonical_configuration",
 *   },
 *   menu = {
 *     "title" = "Jamboree Canonical Configuration",
 *     "description" = "Provides canonical page configuration",
 *     "parent" = "jamboree_canonical.jamboree_canonical",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeCanonicalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_canonical.jamboree_canonical'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionCanonicalConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionCanonicalConfig(array &$form) {
    $default_url = $this->get('canonical_url');
    $form['canonical_config']['canonical_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Canonical URL'),
      '#default_value' => $default_url,
      '#translatable' => TRUE,
    ];

    $d = $this->get('alternate_url');
    $form['fair_gaming_setting']['alternate_url'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Alternate URL'),
      '#default_value' => $d,
      '#format' => $d['format'],
      '#description' => 'Define the hreflang mapping for alternate URL. Pipe seperated URL and hreflang per line.',
      '#translatable' => TRUE,
    ];
  }
}
