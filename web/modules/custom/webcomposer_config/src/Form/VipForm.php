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
      '#rows' => 15,
      '#default_value' => $this->get('vip_mapping_configuration') ?? 'bronze|14,22',
      '#description' => $this->t('VIP Level Mapping. e.g."bronze|14,16" where bronze is the key. 14 and 16 are the iCore VIP ID.'),
    ];

    return $form;
  }

}
