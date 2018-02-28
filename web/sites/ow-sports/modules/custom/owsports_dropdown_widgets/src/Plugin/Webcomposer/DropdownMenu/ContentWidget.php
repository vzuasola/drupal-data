<?php

namespace Drupal\owsports_dropdown_widgets\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * ContentWidget plugin
 *
 * @DropdownMenuPlugin(
 *   id = "content_widget",
 *   name = "Content Widget",
 * )
 */
class ContentWidget extends ConfigFormBase implements DropdownMenuPluginInterface {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_dropdown_menu.dropdown_menu.section.content_widget'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'content_widget_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_dropdown_menu.dropdown_menu.section.content_widget');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The tile title'),
      '#default_value' => $config->get('title'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.content_widget')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}

