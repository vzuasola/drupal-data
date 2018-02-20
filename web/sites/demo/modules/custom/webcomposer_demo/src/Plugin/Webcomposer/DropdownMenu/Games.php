<?php

namespace Drupal\webcomposer_demo\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * Game menu widget plugin
 *
 * @DropdownMenuPlugin(
 *   id = "game",
 *   name = "Game Widget",
 * )
 */
class Games extends ConfigFormBase implements DropdownMenuPluginInterface {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_dropdown_menu.dropdown_menu.section.game'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'game_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_dropdown_menu.dropdown_menu.section.game');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The tile title'),
      '#default_value' => $config->get('title'),
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Subtitle'),
      '#description' => $this->t('The subtile title'),
      '#default_value' => $config->get('description'),
    ];

    $form['button'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button'),
      '#description' => $this->t('The button text'),
      '#default_value' => $config->get('button'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
      'description',
      'button',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.game')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}
