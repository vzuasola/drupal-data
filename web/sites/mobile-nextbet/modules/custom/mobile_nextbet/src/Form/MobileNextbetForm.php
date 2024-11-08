<?php

namespace Drupal\mobile_nextbet\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Header configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_nextbet",
 *   route = {
 *     "title" = "Mobile Nextbet Configuration",
 *     "path" = "/admin/config/mobile/nextbet/configuration",
 *   },
 *   menu = {
 *     "title" = "Mobile Nextbet Configuration",
 *     "description" = "Provides configuration for Nextbet",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */
class MobileNextbetForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_nextbet.nextbet_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Nextbet Configuration'),
    ];

    $this->sectionNextbetConfigs($form);
    $this->sectionFooterConfig($form);

    return $form;
  }

  private function sectionNextbetConfigs(array &$form) {
    $form['nextbet_configuration'] = [
      '#type' => 'details',
      '#title' => t('Nextbet Configuration'),
      '#group' => 'advanced',
    ];

    $form['nextbet_configuration']['all_apps_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View All Apps Here'),
      '#default_value' => $this->get('all_apps_text'),
      '#translatable' => TRUE,
    ];

    $form['nextbet_configuration']['view_less_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('View Less Here'),
      '#default_value' => $this->get('view_less_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['download_app_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Download App Here'),
      '#default_value' => $this->get('download_app_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['contact_us_home_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Here'),
      '#default_value' => $this->get('contact_us_home_text'),
      '#translatable' => true,
    ];

    $form['nextbet_configuration']['parnerts_and_sponsor_title_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Partners and Sponsors Here'),
      '#default_value' => $this->get('parnerts_and_sponsor_title_text'),
      '#translatable' => true,
    ];
  }

  private function sectionFooterConfig(array &$form) {
    $form['nextbet_footer_configuration'] = [
      '#type' => 'details',
      '#title' => t('Nextbet Footer Sections'),
      '#group' => 'advanced',
    ];

    $form['nextbet_footer_configuration']['enable_social_media'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Social Media'),
      '#default_value' => $this->get('enable_social_media'),
      '#translatable' => TRUE,
    ];

    $form['nextbet_footer_configuration']['enable_about_section'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable About Section'),
      '#default_value' => $this->get('enable_about_section'),
      '#translatable' => TRUE,
    ];
  }
}
