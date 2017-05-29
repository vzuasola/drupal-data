<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration Form for Annoucement LightBox.
 */
class AnnouncementLightBoxConfig extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.announcement_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'announcement_config_settings_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('casino_config.announcement_config');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['announcement_details'] = [
      '#type' => 'details',
      '#title' => t('Announcement LigthBox Settings'),
      '#group' => 'advanced',
    ];

    $form['announcement_details']['announcement_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Announcement LigthBox Title'),
      '#description' => $this->t('Text to be displayed on top of the Announcement Lightbox.'),
      '#default_value' => $config->get('announcement_title'),
      '#required' => TRUE,
    ];

    $form['announcement_details']['announcement_default_msg'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Announcement LigthBox default message'),
      '#description' => $this->t('The message shown to player if there are no published announcements.'),
      '#default_value' => $config->get('announcement_default_msg'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $announcementValuesKeys = [
      'announcement_title',
      'announcement_default_msg',
    ];
    foreach ($announcementValuesKeys as $keys) {
      $this->config('casino_config.announcement_config')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
