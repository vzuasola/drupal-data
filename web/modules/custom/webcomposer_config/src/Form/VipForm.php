<?php

namespace Drupal\webcomposer_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * VIP configuration plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_config_vip",
 *   route = {
 *     "title" = "VIP Configuration",
 *     "path" = "/admin/config/webcomposer/config/vip",
 *   },
 *   menu = {
 *     "title" = "VIP Configuration",
 *     "description" = "Provides configuration for VIP",
 *     "parent" = "webcomposer_config.list",
 *   },
 * )
 */
class VipForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.vip_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['vip_mapping_configuration'] = [
      '#type' => 'textarea',
      '#title' => $this->t('VIP Configuration'),
      '#default_value' => $this->get('vip_mapping_configuration') ?: 'bronze|14',
      '#description' => $this->t('VIP Level Mapping. e.g."bronze|14,16" where bronze is the key. 14 is the iCore VIP ID.'),
    ];
    $form['vip_badge_tooltip'] = [
      '#type' => 'textarea',
      '#title' => $this->t('VIP badge tooltip'),
      '#default_value' => $this->get('vip_badge_tooltip') ?: "bronze|You're a Bronze VIP Member",
      '#description' => $this->t('VIP Level Mapping. e.g."bronze|You are a Bronze VIP Member" where bronze is the ' .
        'key and the former is the text that will be displayed'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    return $form;
  }

}
