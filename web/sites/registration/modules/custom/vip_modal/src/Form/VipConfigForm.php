<?php

namespace Drupal\vip_modal\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * VIP configuration plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "vip_content_config",
 *   route = {
 *     "title" = "VIP Configuration",
 *     "path" = "/admin/config/webcomposer/vip_modal/content",
 *   },
 *   menu = {
 *     "title" = "VIP Content Configuration",
 *     "description" = "VIP Content configuration",
 *     "parent" = "vip_modal.list",
 *   },
 * )
 */
class VipConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.vip_content_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['vip_settings_tab'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->rewardsAndRecognitionSection($form);

    return $form;
  }

  /**
   * Rewards and Recognition Section.
   */
  private function rewardsAndRecognitionSection(array &$form) {
    $form['rewards_section'] = [
      '#type' => 'details',
      '#title' => $this->t('Rewards and Recognition'),
      '#collapsible' => TRUE,
      '#group' => 'vip_settings_tab',
    ];

    $dv = $this->get('rewards_recognition_content');
    $form['rewards_section']['rewards_recognition_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $dv['value'] ?: '',
      '#format' => $dv['format'],
      '#description' => $this->t('VIP rewards and recognition content'),
      '#translatable' => TRUE,
    ];
  }

}
