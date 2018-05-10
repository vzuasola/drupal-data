<?php

namespace Drupal\webcomposer_announcements\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Config form for Announcement feature.
 */
class AnnouncementConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.announcements_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_announcements.announcements_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('webcomposer_config.announcements_configuration');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Title of the announcement lightbox.'),
      '#default_value' => $config->get('title'),
      '#required' => TRUE,
    ];

    $form['default_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default Message'),
      '#description' => $this->t('Message to display inside the lightbox when there is no published announcement.'),
      '#default_value' => $config->get('default_message'),
      '#required' => TRUE,
    ];

    $form['see_all'] = [
      '#type' => 'textfield',
      '#title' => $this->t('See all text'),
      '#description' => $this->t('Announcement see all text.'),
      '#default_value' => $config->get('see_all'),
      '#required' => TRUE,
    ];

    $form['dismiss_all'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dismiss all text'),
      '#description' => $this->t('Announcement dismiss all text.'),
      '#default_value' => $config->get('dismiss_all'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $keys = [
      'title',
      'default_message',
      'see_all',
      'dismiss_all'
    ];

    foreach ($keys as $key) {
      $this->config('webcomposer_config.announcements_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
