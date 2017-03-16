<?php

namespace Drupal\casino_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Provides configuration settings form for Header Element Configuration.
 */
class HeaderConfiguration extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_config.header_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'header_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('casino_config.header_config');

    $form['header_settings_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );
    $form['join_now_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Join Now Button Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['join_now_group']['join_now_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Join Now Button Text'),
      '#description' => $this->t('The text to be displayed on the Join Now Button.'),
      '#default_value' => $config->get('join_now_text'),
      '#required' => TRUE,
    );
    $form['join_now_group']['join_now_link'] = array(
      '#type' => 'url',
      '#title' => $this->t('Join Now Link'),
      '#description' => $this->t('The link for user redirection when clicked on Join Now Button.'),
      '#default_value' => $config->get('join_now_link'),
      '#required' => TRUE,
    );
    $form['login_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Login Issue Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',

    );
    $form['login_group']['login_issue_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Login Issue Text'),
      '#description' => $this->t('The text to be displayed on User Login Issue.'),
      '#default_value' => $config->get('login_issue_text'),
      '#required' => TRUE,
    );
    $form['casino_logo_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Casino Logo Settings'),
      '#collapsible' => TRUE,
      '#group' => 'header_settings_tab',
    );
    $form['casino_logo_group']['casino_logo'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Casino Logo Image'),
      '#description' => t('One file only.Allowed types : png gif jpg jpeg.'),
      '#default_value' => $config->get('casino_logo'),
      '#upload_location' => 'public://images/',
      '#upload_validators'  => array(
        'file_validate_extensions' => array('png gif jpg jpeg'),
      ),
      '#required' => TRUE,
    );
    $form['casino_logo_group']['casino_logo_alt'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Logo Alternaive Text'),
      '#description' => $this->t('This text will be used by screen readers, search engines, or when the image cannot be loaded.'),
      '#default_value' => $config->get('casino_logo_alt'),
      '#required' => TRUE,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = array(
      'join_now_text',
      'join_now_link',
      'login_issue_text',
      'casino_logo_alt',
      'casino_logo',
    );

    $icon_field = $form_state->getValue('casino_logo');
    $file_id = empty($icon_field) ? FALSE : reset($icon_field);
    if (!empty($file_id)) {
      // Permanently saving the image files.
      $file = File::load($file_id);
      $file->status = FILE_STATUS_PERMANENT;
      $file->save();
    }
    foreach ($keys as $key) {
      $this->config('casino_config.header_config')->set($key, $form_state->getValue($key))->save();
    }
    parent::submitForm($form, $form_state);
  }

}
