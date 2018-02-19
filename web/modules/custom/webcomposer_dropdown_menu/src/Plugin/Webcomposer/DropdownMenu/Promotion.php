<?php

namespace Drupal\webcomposer_dropdown_menu\Plugin;

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
    return ['webcomposer_dropdown_menu.promotion'];
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
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    return parent::submitForm($form, $form_state);
  }
}

