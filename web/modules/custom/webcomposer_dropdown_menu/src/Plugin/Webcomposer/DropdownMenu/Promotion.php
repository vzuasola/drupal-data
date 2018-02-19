<?php

namespace Drupal\webcomposer_dropdown_menu\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * Promotion plugin
 *
 * @DropdownMenuPlugin(
 *   id = "promotion",
 *   name = "Promotions",
 * )
 */
class Promotion extends ConfigFormBase implements DropdownMenuPluginInterface {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_dropdown_menu.dropdown_menu.section.promotion'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'promotion_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_dropdown_menu.dropdown_menu.section.promotion');

    $form['markup'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Markup'),
      '#description' => $this->t('The markup that will be used as substitute to Curacao'),
      '#default_value' => $config->get('markup'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'markup',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.promotion')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}

