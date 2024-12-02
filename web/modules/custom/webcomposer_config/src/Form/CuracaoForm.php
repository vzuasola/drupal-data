<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Curacao configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_curacao",
 *   route = {
 *     "title" = "Curacao/GCB Configuration",
 *     "path" = "/admin/config/webcomposer/config/curacao",
 *   },
 *   menu = {
 *     "title" = "Curacao/GCB Configuration",
 *     "description" = "Provides configuration for Curacao GCB",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class CuracaoForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.curacao'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Curacao/GCB Configuration'),
    ];

    $form['curacao'] = [
      '#type' => 'details',
      '#title' => $this->t('Curacao/GCB Settings'),
      '#collapsible' => TRUE,
      '#group' => 'advanced',
    ];
    $form['curacao']['info'] = [
      '#type' => 'markup',
      '#markup' => $this->t("<div>Works with the (Responsive) Partner list module, a partner with id \"curacao\" will be replaced by the GCB Seal markup</div>"),
    ];
    $form['curacao']['gcb_feature_flag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable'),
      '#description' => $this->t('Enable GCB Seal'),
      '#default_value' => $this->get('gcb_feature_flag'),
      '#translatable' => TRUE
    ];

    $form['curacao']['gcb_image_url'] = [
      '#type' => 'textfield',
      '#title' => t('Seal Image URL'),
      '#default_value' => $this->get('gcb_image_url'),
    ];

    $form['curacao']['gcb_link'] = [
      '#type' => 'textfield',
      '#title' => t('Seal URL'),
      '#description' => $this->t('URL user will be linked to,"{gcb_token}" will be replaced with the domain token'),
      '#default_value' => $this->get('gcb_link'),
    ];
  
    $form['curacao']['gcb_domain_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('GCB Domain Mapping'),
      '#description' => $this->t('List of GCB Enabled domains with their tokens. Example "elysium-dfbt.com|TOKEN", one per line, no www or subdomain'),
      '#default_value' => $this->get('gcb_domain_mapping'),
    ];

    return $form;
  }
}