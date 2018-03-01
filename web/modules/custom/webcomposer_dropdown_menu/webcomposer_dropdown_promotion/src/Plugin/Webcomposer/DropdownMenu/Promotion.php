<?php

namespace Drupal\webcomposer_dropdown_promotion\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * Promotion plugin
 *
 * @DropdownMenuPlugin(
 *   id = "promotion",
 *   name = "Promotions Widget",
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

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The tile title'),
      '#default_value' => $config->get('title'),
      '#required' => true,
    ];

    $form['promotion_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Endpoint'),
      '#description' => $this->t('The path wherein promotion data will be fetched from'),
      '#default_value' => $config->get('promotion_endpoint'),
      '#required' => true,
    ];

    $form['promotion_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Link'),
      '#description' => $this->t('The link that redirects to the promotion page'),
      '#default_value' => $config->get('promotion_link'),
      '#required' => true,
    ];

    $form['promotion_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Link Text'),
      '#description' => $this->t('The label for the promotion link'),
      '#default_value' => $config->get('promotion_link_text'),
      '#required' => true,
    ];

    $form['promotion_error_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Promotion Error Message'),
      '#description' => $this->t('The error message to show'),
      '#default_value' => $config->get('promotion_error_message'),
      '#required' => true,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
      'promotion_endpoint',
      'promotion_link',
      'promotion_link_text',
      'promotion_error_message'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.promotion')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}

