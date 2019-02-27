<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_download",
 *   route = {
 *     "title" = "Download Configuration",
 *     "path" = "/admin/config/zipang/download_configuration",
 *   },
 *   menu = {
 *     "title" = "Download Configuration",
 *     "description" = "Provides download configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangDownloadConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.download_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Zipang Configurations'),
    ];

    $this->sectionFloatingBanner($form);
    $this->sectionDownloadFile($form);
    $this->sectionDownloadPage($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionFloatingBanner(array &$form) {
    $form['floating_banner'] = [
      '#type' => 'details',
      '#title' => $this->t('Floating Banner'),
    ];

    $form['floating_banner']['floating_banner_image_url'] = [
      '#type' => 'textfield',
      '#title' => t('Floating Banner Image URL'),
      '#default_value' => $this->get('floating_banner_image_url'),
      '#description' => $this->t('Suggested image dimension: 80 x 300 pixels'),
      '#translatable' => TRUE,
    ];

    $form['floating_banner']['floating_banner_link'] = [
      '#type' => 'textfield', 
      '#title' => t('Floating Banner Link'),
      '#default_value' => $this->get('floating_banner_link'),
      '#description' => $this->t('Download Page URL'),
      '#translatable' => TRUE,
    ];

  }

  /**
   * {@inheritdoc}
   */
  private function sectionDownloadFile(array &$form) {
    $form['download'] = [
      '#type' => 'details',
      '#title' => $this->t('Download File'),
    ];


    $default_download_file = $this->get('download_file');
    $form['download']['download_file'] = [
      '#type' => 'textfield',
      '#title' => t('Download File URL'),
      '#default_value' => $default_download_file,
      '#description' => $this->t('Download File URL Location'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionDownloadPage(array &$form) {
    $form['download_page'] = [
      '#type' => 'details',
      '#title' => $this->t('Download Page'),
    ];


    $default_download_title = $this->get('download_title');
    $form['download_page']['download_title'] = [
      '#type' => 'textfield',
      '#title' => t('Download Title'),
      '#default_value' => $default_download_title,
      '#description' => $this->t('Download Page title'),
      '#translatable' => TRUE,
    ];

    $default_download_message_pre = $this->get('download_message_pre');
    $form['download_page']['download_message_pre'] = [
      '#type' => 'text_format',
      '#title' => t('Download Page Message (Pre Login)'),
      '#default_value' => $default_download_message_pre['value'],
      '#description' => $this->t('Download Page Message. (Pre Login)'),
      '#format' => $default_download_message_pre['format'],
      '#translatable' => TRUE,
    ];

    $default_download_message_post = $this->get('download_message_post');
    $form['download_page']['download_message_post'] = [
      '#type' => 'text_format',
      '#title' => t('Download Page Message (Post Login)'),
      '#default_value' => $default_download_message_post['value'],
      '#description' => $this->t('Download Page Message. (Post Login)'),
      '#format' => $default_download_message_pre['format'],
      '#translatable' => TRUE,
    ];
  }
}


