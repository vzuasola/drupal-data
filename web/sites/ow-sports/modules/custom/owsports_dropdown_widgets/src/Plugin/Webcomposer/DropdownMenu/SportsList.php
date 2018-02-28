<?php

namespace Drupal\owsports_dropdown_widgets\Plugin\Webcomposer\DropdownMenu;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

use Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface;

/**
 * SportsList plugin
 *
 * @DropdownMenuPlugin(
 *   id = "sportslist",
 *   name = "SportsList Widget",
 * )
 */
class SportsList extends ConfigFormBase implements DropdownMenuPluginInterface {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_dropdown_menu.dropdown_menu.section.sportslist'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sportslist_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_dropdown_menu.dropdown_menu.section.sportslist');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The tile title'),
      '#default_value' => $config->get('title'),
    ];

    $form['subtitle_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sub Title Link Text'),
      '#description' => $this->t('Sub Title Link Text'),
      '#default_value' => $config->get('subtitle_link_text'),
    ];

    $form['subtitle_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Sub Title Link'),
      '#description' => $this->t('Sub Title Link'),
      '#default_value' => $config->get('subtitle_link'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'title',
      'subtitle_link_text',
      'subtitle_link',
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_dropdown_menu.dropdown_menu.section.sportslist')->set($key, $form_state->getValue($key))->save();
    }

    return parent::submitForm($form, $form_state);
  }
}

