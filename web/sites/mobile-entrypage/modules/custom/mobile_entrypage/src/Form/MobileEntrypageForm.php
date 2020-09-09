<?php

namespace Drupal\mobile_entrypage\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_entrypage",
 *   route = {
 *     "title" = "Mobile Entrypage Configuration",
 *     "path" = "/admin/config/mobile/entrypage/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Entrypage Configuration",
 *     "description" = "Provides configuration for Entrypage",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileEntrypageForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_entrypage.entrypage_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Entrypage Configuration'),
    ];

    $this->sectionEntrypageConfigs($form);
    $this->sectionEntrypageFooter($form);
    $this->sectionDownloadLightbox($form);

    return $form;
  }

  private function sectionEntrypageConfigs(array &$form) {
    $form['entrypage_configuration'] = [
      '#type' => 'details',
      '#title' => t('Entrypage Configuration'),
      '#group' => 'advanced',
    ];

    $form['entrypage_configuration']['all_apps_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View All Apps Here'),
      '#default_value' => $this->get('all_apps_text'),
      '#translatable' => TRUE,
    ];

    $form['entrypage_configuration']['view_less_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View Less Here'),
      '#default_value' => $this->get('view_less_text'),
      '#translatable' => true,
    ];

    $form['entrypage_configuration']['download_app_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download App Here'),
      '#default_value' => $this->get('download_app_text'),
      '#translatable' => true,
    ];

    $form['entrypage_configuration']['contact_us_home_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Here'),
      '#default_value' => $this->get('contact_us_home_text'),
      '#translatable' => true,
    ];

    $form['entrypage_configuration']['parnerts_and_sponsor_title_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Partners and Sponsors Here'),
      '#default_value' => $this->get('parnerts_and_sponsor_title_text'),
      '#translatable' => true,
    ];
  }

  private function sectionEntrypageFooter(array &$form) {
    $form['entrypage_configuration_footer'] = [
      '#type' => 'details',
      '#title' => $this->t('India Language Selector'),
      '#group' => 'advanced',
    ];

    $form['entrypage_configuration_footer']['enable_popup_in_language'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable popup IN language'),
      '#default_value' => $this->get('enable_popup_in_language'),
      '#description' => $this->t('This will enable popup IN language'),
    ];

    $form['entrypage_configuration_footer']['mobile_language_select'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Select Language Text'),
      '#description' => $this->t('Select Language text for language lightbox.'),
      '#default_value' => $this->get('mobile_language_select'),
      '#translatable' => TRUE
    ];

    $form['entrypage_configuration_footer']['mobile_language_svg_class'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Svg'),
      '#description' => $this->t('svg class'),
      '#default_value' => $this->get('mobile_language_svg_class'),
      '#translatable' => TRUE
    ];

    $form['entrypage_configuration_footer']['mobile_language_code'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Code'),
      '#description' => $this->t('IN Language Code - <i>"icore-lang|data-lang-prefix|language text"</i> example: en-IN|in|English'),
      '#default_value' => $this->get('mobile_language_code')
    ];

    $defaultValue = $this->get('mobile_language_description_select');
    $form['entrypage_configuration_footer']['mobile_language_description_select'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Language Description Text'),
      '#default_value' => $defaultValue['value'],
      '#format' => $defaultValue['format'],
      '#translatable' => true,
    ];
  }

  private function sectionDownloadLightbox(array &$form)
  {
    $form['entrypage_configuration_download_popup'] = [
      '#type' => 'details',
      '#title' => t('Download Lightbox Configuration'),
      '#group' => 'advanced',
    ];

    $form['entrypage_configuration_download_popup']['file_image_page_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#description' => $this->t('Adds page image to the download lightbox.'),
      '#default_value' => $this->get('file_image_page_image'),
      '#translatable' => TRUE,
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['entrypage_configuration_download_popup']['download_app'] = [
      '#type' => 'details',
      '#title' => $this->t('Download App'),
      '#description' => $this->t('Download App Section'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['entrypage_configuration_download_popup']['download_app']['download_app_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download App Title'),
      '#default_value' => $this->get('download_app_title'),
      '#translatable' => TRUE,
    ];

    $defaultValue = $this->get('mobile_download_description_select');
    $form['entrypage_configuration_download_popup']['download_app']['mobile_download_description_select'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Download App Description'),
      '#default_value' => $defaultValue['value'],
      '#format' => $defaultValue['format'],
      '#translatable' => true,
    ];

    $form['entrypage_configuration_download_popup']['download_app']['download_app_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download Link'),
      '#default_value' => $this->get('download_app_link'),
      '#translatable' => TRUE,
    ];

    $form['entrypage_configuration_download_popup']['launch_app'] = [
      '#type' => 'details',
      '#title' => $this->t('Launch App'),
      '#description' => $this->t('Launch App Section'),
      '#collapsible' => TRUE,
      '#open' => FALSE,
    ];

    $form['entrypage_configuration_download_popup']['launch_app']['launch_app_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Launch App Title'),
      '#default_value' => $this->get('launch_app_title'),
      '#translatable' => true,
    ];

    $defaultValue = $this->get('mobile_launch_description_select');
    $form['entrypage_configuration_download_popup']['launch_app']['mobile_launch_description_select'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Launch App Description'),
      '#default_value' => $defaultValue['value'],
      '#format' => $defaultValue['format'],
      '#translatable' => true,
    ];

    $form['entrypage_configuration_download_popup']['launch_app']['launch_app_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Launch Link'),
      '#default_value' => $this->get('launch_app_link'),
      '#translatable' => TRUE,
    ];
  }
}
