<?php

namespace Drupal\webcomposer_announcements\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class AnnouncementConfigurationForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_announcements.announcements_configuration'];
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
    $config = $this->config('webcomposer_announcements.announcements_configuration');

    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Title of the announcement lightbox.'),
      '#default_value' => $config->get('title'),
      '#required' => TRUE,
    );

    $form['default_message'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Default Message'),
      '#description' => $this->t('Message to display inside the lightbox when there is no published announcement.'),
      '#default_value' => $config->get('default_message'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    
    $keys = array(
      'title',
      'default_message',
    );

    foreach ($keys as $key) {
      $this->config('webcomposer_announcements.announcements_configuration')->set($key, $form_state->getValue($key))->save();
    }
  }

}
