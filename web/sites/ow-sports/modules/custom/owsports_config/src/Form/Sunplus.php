<?php

namespace Drupal\owsports_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sunplus Configuration
 *
 * @WebcomposerConfigPlugin(
 *   id = "sunplus",
 *   route = {
 *     "title" = "Sunplus",
 *     "path" = "/admin/config/owsports/sunplus",
 *   },
 *   menu = {
 *     "title" = "Sunplus",
 *     "description" = "Provides Sunplus configuration",
 *     "parent" = "owsports_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class Sunplus extends FormBase {

  const MAINTENANCE_TIMEZONE = 'UTC';

  const MAINTENANCE_TIME_FORMAT = 'm/d/Y H:i:s';

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.sunplus'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['sunplus_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->sectionGeneral($form);
    $this->sectionMaintenance($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $publishStatus = $form_state->getValue('maintenance_feature');
    $publishDate = $form_state->getValue('maintenance_publish_date')
      ? $form_state->getValue('maintenance_publish_date')->getTimestamp()
      : '';
    $unpublishDate = $form_state->getValue('maintenance_unpublish_date')
      ? $form_state->getValue('maintenance_unpublish_date')->getTimestamp()
      : '';

    if ($publishStatus) {
      if (!$publishDate || !$unpublishDate) {
        $form_state->setErrorByName('maintenance_publish_date',
        t('Please add publish and unpublish date; if you are enabling the soft maintenance.'));
        $form_state->setErrorByName('maintenance_unpublish_date');
      }
      if ($unpublishDate < $publishDate) {
        $form_state->setErrorByName('maintenance_unpublish_date',
        t('Unpublish date for maintenance should be greater than the publish date.'));
      }
      if ($publishDate < strtotime('now')) {
        $form_state->setErrorByName('maintenance_publish_date',
        t('Publish date should be set on future time.'));
      }
      if ($unpublishDate < strtotime('now')) {
        $form_state->setErrorByName('maintenance_publish_date',
        t('Unpublish date should be set on future time.'));
      }
    } else {
      if ($publishDate || $unpublishDate) {
        $form_state->setErrorByName('maintenance_feature',
        t('Please enable soft maintenance feature.'));
      }
    }

    parent::validateForm($form, $form_state);
  }

  /**
   *
   */
  private function sectionGeneral(array &$form) {
    $form['general_group'] = [
      '#type' => 'details',
      '#title' => $this->t('General'),
      '#collapsible' => TRUE,
      '#group' => 'sunplus_settings_tab',
    ];

    $form['general_group']['pre_login_sunplus_domain'] = [
      '#type' => 'textarea',
      '#rows' => 1,
      '#title' => $this->t('Pre Login Sunplus Domain'),
      '#description' => $this->t('Pre Login Sunplus Domain.'),
      '#default_value' => $this->get('pre_login_sunplus_domain'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_group']['post_login_sunplus_domain'] = [
      '#type' => 'textarea',
      '#rows' => 1,
      '#title' => $this->t('Post Login Sunplus Domain'),
      '#description' => $this->t('Post Login Sunplus Domain.'),
      '#default_value' => $this->get('post_login_sunplus_domain'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_group']['iframe_width'] = [
      '#type' => 'textarea',
      '#rows' => 1,
      '#title' => $this->t('Sunplus Iframe Width.'),
      '#description' => $this->t('Sunplus Iframe Width.'),
      '#default_value' => $this->get('iframe_width'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_group']['iframe_height'] = [
      '#type' => 'textarea',
      '#rows' => 1,
      '#title' => $this->t('Sunplus Iframe Height.'),
      '#description' => $this->t('Sunplus Iframe Height.'),
      '#default_value' => $this->get('iframe_height'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['general_group']['url_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iFrame URL parameters'),
      '#description' => $this->t('query parameters for iFrame. To add use key=value, keyword|key=value'),
      '#default_value' => $this->get('url_param'),
    ];

    $form['general_group']['right_side_block'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Right Side Block'),
      '#default_value' => $this->get('right_side_block'),
      '#description' => $this->t('Enable this feature to hide the right side block below 1370px and lower width of screen.'),
    ];

    $form['general_group']['user_preference'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable User Preference'),
      '#default_value' => $this->get('user_preference'),
      '#description' => $this->t('Enabling User Preference will automatically save last template visited by Player per language.'),
    ];

    $form['general_group']['how_to_bet_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How to bet URI'),
      '#default_value' => $this->get('how_to_bet_uri'),
    ];
  }

  /**
   *
   */
  private function sectionMaintenance(array &$form) {
    $form['maintenance_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Maintenance'),
      '#collapsible' => TRUE,
      '#group' => 'sunplus_settings_tab',
    ];

    $form['maintenance_group']['maintenance_feature'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Soft Maintenance Page Status'),
      '#description' => $this->t('Enable this feature to show the soft maintenance page behaviour in the frontend.'),
      '#default_value' => $this->get('maintenance_feature'),
    ];

    $form['maintenance_group']['file_image_maintenance'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Maintenance Image'),
      '#default_value' => $this->get('file_image_maintenance'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['maintenance_group']['maintenance_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Maintenance Content'),
      '#description' => $this->t('Maintenance blurb content to display.'),
      '#default_value' => $this->get('maintenance_content')['value'],
      '#format' => $this->get('maintenance_content')['format'],
      '#translatable' => TRUE,
    ];

    $form['maintenance_group']['maintenance_publish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Publish Date'),
      '#description' => $this->t('Publishing date for the maintenance page.'),
      '#default_value' => $this->get('maintenance_publish_date', ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
      '#date_timezone' => drupal_get_user_timezone(),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
    ];

    $form['maintenance_group']['maintenance_unpublish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Unpublish Date'),
      '#description' => $this->t('Unpublishing date for the maintenance page.'),
      '#default_value' => $this->get('maintenance_unpublish_date', ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
      '#date_timezone' => drupal_get_user_timezone(),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
    ];
  }
}
