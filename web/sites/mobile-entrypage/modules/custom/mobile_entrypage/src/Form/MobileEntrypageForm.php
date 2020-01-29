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
      '#title' => $this->t('Language Selector'),
      '#group' => 'advanced',
    ];

    $form['entrypage_configuration_footer']['mobile_language_select'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Select Language Text'),
      '#description' => $this->t('Select Language text for language lightbox.'),
      '#default_value' => $this->get('mobile_language_select'),
      '#translatable' => TRUE
    ];

    $defaultValue = $this->get('mobile_language_description_select');
    $form['entrypage_configuration_footer']['mobile_language_description_select'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Select Language Description Text'),
      '#default_value' => $defaultValue['value'],
      '#format' => $defaultValue['format'],
      '#translatable' => true,
    ];
  }
}
