<?php

namespace Drupal\webcomposer_announcements\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Announcement custom config form
 *
 * @WebcomposerConfigPlugin(
 *   id = "announcement_custom_config_form",
 *   route = {
 *     "title" = "Web Composer Announcement Configuration",
 *     "path" = "/admin/config/webcomposer/announcements/config",
 *   },
 *   menu = {
 *     "title" = "Web Composer Announcement Configuration",
 *     "description" = "Configure the announcements custom configuration",
 *     "parent" = "webcomposer_announcements.admin_settings",
 *   },
 * )
 */
class AnnouncementConfigurationForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.announcements_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Title of the announcement lightbox.'),
      '#default_value' => $this->get('title'),
      '#required' => TRUE,
      '#translatable' => true
    ];

    $form['default_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Message'),
      '#description' => $this->t('Message to display inside the lightbox when there is no published announcement.'),
      '#default_value' => $this->get('default_message'),
      '#required' => TRUE,
      '#translatable' => true
    ];

    $form['see_all'] = [
      '#type' => 'textfield',
      '#title' => $this->t('See all text'),
      '#description' => $this->t('Announcement see all text.'),
      '#default_value' => $this->get('see_all'),
      '#required' => TRUE,
      '#translatable' => true
    ];

    $form['dismiss_all'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dismiss all text'),
      '#description' => $this->t('Announcement dismiss all text.'),
      '#default_value' => $this->get('dismiss_all'),
      '#required' => TRUE,
      '#translatable' => true
    ];

    return $form;
  }
}
