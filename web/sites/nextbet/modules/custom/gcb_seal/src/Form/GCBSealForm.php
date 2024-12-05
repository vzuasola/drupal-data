<?php

namespace Drupal\gcb_seal\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "gcb_seal",
 *   route = {
 *     "title" = "GCB Seal Configuration",
 *     "path" = "/admin/config/gcbseal/configuration",
 *   },
 *   menu = {
 *     "title" = "GCB Seal Configuration",
 *     "description" = "Provides configuration for GCB Seal certificate",
 *     "parent" = "nextbet_config.list",
 *   },
 * )
 */
class GCBSealForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['gcb_seal.gcb_seal_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('GCB Seal Configuration'),
    ];

    $this->sectionGCBSealConfigs($form);

    return $form;
  }

  private function sectionGCBSealConfigs(array &$form) {
    $form['gcb_seal_configuration'] = [
      '#type' => 'details',
      '#title' => t('GCB Seal Configuration'),
      '#group' => 'advanced',
    ];

    $form['gcb_seal_configuration']['gcb_seal_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('GCB Seal URL'),
      '#default_value' => $this->get('gcb_seal_url'),
      '#description' => $this->t('GCB Seal URL for certificate verification with DOMAIN_TOKEN.'),
      '#translatable' => true,
    ];

    $form['gcb_seal_configuration']['gcb_seal_image_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('GCB Seal image URL'),
      '#default_value' => $this->get('gcb_seal_image_url'),
      '#description' => $this->t('Enter the URL for the image that will be displayed to us from the GCB site.'),
      '#translatable' => true,
    ];

    $form['gcb_seal_configuration']['gcb_seal_domain_whitelist'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Whitelist domain where GCB Seal will be displayed'),
      '#default_value' => $this->get('gcb_seal_domain_whitelist'),
      '#description' => $this->t(
        'Please enter the domains where the GCB seal will be displayed. ' .
        'Separate multiple domains with placing them in new line'
      ),
      '#translatable' => true,
    ];

    $form['gcb_seal_configuration']['enable_gcb_seal'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable GCB Seal'),
      '#default_value' => $this->get('enable_gcb_seal'),
      '#description' => $this->t('If checkbox is clicked gcb seal will be enabled on FE'),
      '#translatable' => true,
    ];
  }
}
