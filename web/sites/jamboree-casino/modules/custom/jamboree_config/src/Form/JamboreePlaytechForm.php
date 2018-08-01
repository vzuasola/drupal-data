<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_pt_configuration",
 *   route = {
 *     "title" = "Jamboree Playtech Configuration",
 *     "path" = "/admin/config/jamboree/playtech_configuration",
 *   },
 *   menu = {
 *     "title" = "Jamboree Playtech Configuration",
 *     "description" = "Provides registration configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreePlaytechForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.jamboree_pt_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Playtech Configuration'),
    ];

    $this->sectionPlaytechSettings($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionPlaytechSettings(array &$form) {
    $form['pt_settings'] = [
      '#type' => 'details',
      '#title' => t('Playtech Settings'),
      '#group' => 'advanced',
    ];
    $form['pt_settings']['pt_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech API Hostname'),
      '#default_value' => $this->get('pt_host'),
    ];
    $form['pt_settings']['casino_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Name'),
      '#default_value' => $this->get('casino_name'),
    ];

    $form['pt_settings']['secret_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Playtech Casino Secret Key'),
      '#default_value' => $this->get('secret_key'),
    ];
  }
}
