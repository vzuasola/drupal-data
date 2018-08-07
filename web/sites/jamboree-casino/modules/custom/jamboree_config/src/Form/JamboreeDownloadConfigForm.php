<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_download",
 *   route = {
 *     "title" = "Download Configuration",
 *     "path" = "/admin/config/jamboree/download_configuration",
 *   },
 *   menu = {
 *     "title" = "Download Configuration",
 *     "description" = "Provides download configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeDownloadConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.download_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionDownloadFile($form);
    $this->sectionDownloadPage($form);

    return $form;
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


