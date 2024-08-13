<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * floating banners custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "left_floating_banner_config_form",
 *   route = {
 *     "title" = "Floating Banner Configure",
 *     "path" = "/admin/config/webcomposer_floating_banners/config",
 *   },
 *   menu = {
 *     "title" = "Floating Banner Configure",
 *     "description" = "Configure the floating banners",
 *     "parent" = "webcomposer_floating_banners.list",
 *   },
 * )
 */
class LeftFloatingBannerConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.floating_banner_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['LeftFloatingBannerEntity_settings']['enable_per_product'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Per Product Configuration'),
      '#default_value' => $this->get('enable_per_product'),
    ];

    $form['LeftFloatingBannerEntity_settings']['banner_v2_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable V2'),
      '#default_value' => $this->get('banner_v2_enable'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
