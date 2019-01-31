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
      '#title' => t('Settings'),
      '#type' => 'vertical_tabs',
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
      '#collapsible' => TRUE,
      '#title' => $this->t('General'),
      '#group' => 'sunplus_settings_tab',
    ];

    $form['general_group']['pre_login_sunplus_src'] = [
      '#rows' => 1,
      '#required' => TRUE,
      '#type' => 'textarea',
      '#translatable' => TRUE,
      '#title' => $this->t('Pre Login Sunplus Domain'),
      '#description' => $this->t('Ex:- https://prices.{sunplus.domain}/' .
        'Deposit_ProcessLogin.aspx?lang=en&iseuro=0&webskintype=3&act=' .
        '{sunplus.act}&otype=4.'),
      '#default_value' => $this->get('pre_login_sunplus_src'),
    ];

    $form['general_group']['post_login_sunplus_src'] = [
      '#rows' => 1,
      '#required' => TRUE,
      '#type' => 'textarea',
      '#translatable' => TRUE,
      '#title' => $this->t('Post Login Sunplus Domain'),
      '#description' => $this->t('Ex:- https://play.{sunplus.domain}/' .
        'Deposit_ProcessLogin.aspx?lang=en&iseuro=0&webskintype=3&act=' .
        '{sunplus.act}&otype=4.'),
      '#default_value' => $this->get('post_login_sunplus_src'),
    ];

    $form['general_group']['iframe_width'] = [
      '#size' => 10,
      '#required' => TRUE,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#title' => $this->t('Sunplus Iframe Width.'),
      '#description' => $this->t('Sunplus Iframe Width.'),
      '#default_value' => $this->get('iframe_width'),
    ];

    $form['general_group']['iframe_height'] = [
      '#size' => 10,
      '#required' => TRUE,
      '#type' => 'textfield',
      '#translatable' => TRUE,
      '#title' => $this->t('Sunplus Iframe Height.'),
      '#default_value' => $this->get('iframe_height'),
      '#description' => $this->t('Sunplus Iframe Height.'),
    ];

    $form['general_group']['right_side_block'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Right Side Block'),
      '#default_value' => $this->get('right_side_block'),
      '#description' => $this->t('Enable this feature to hide the right' .
        'side block below 1370px and lower width of screen.'),
    ];

    $form['general_group']['user_preference'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable User Preference'),
      '#default_value' => $this->get('user_preference'),
      '#description' => $this->t('Enabling User Preference will automatically' .
       'save last template visited by Player per language.'),
      '#translatable' => TRUE,
    ];

    $form['general_group']['menu_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Add Iframe Url Param in Menu'),
      '#description' => $this->t('query parameters for iFrame. To add use key=value, keyword|key=value'),
      '#default_value' => $this->get('menu_param'),
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionMaintenance(array &$form) {
    $form['maintenance_group'] = [
      '#type' => 'details',
      '#collapsible' => TRUE,
      '#group' => 'sunplus_settings_tab',
      '#title' => $this->t('Maintenance'),
    ];

    $form['maintenance_group']['maintenance_feature'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Soft Maintenance Page Status'),
      '#default_value' => $this->get('maintenance_feature'),
      '#description' => $this->t('Enable this feature to show the soft' .
        ' maintenance page behaviour in the frontend.'),
    ];

    $form['maintenance_group']['file_image_maintenance'] = [
      '#type' => 'managed_file',
      '#upload_location' => 'public://',
      '#title' => $this->t('Maintenance Image'),
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
      '#default_value' => $this->get('file_image_maintenance'),
    ];

    $form['maintenance_group']['maintenance_content'] = [
      '#type' => 'text_format',
      '#translatable' => TRUE,
      '#title' => $this->t('Maintenance Content'),
      '#format' => $this->get('maintenance_content')['format'],
      '#default_value' => $this->get('maintenance_content')['value'],
      '#description' => $this->t('Maintenance blurb content to display.'),
    ];

    $form['maintenance_group']['maintenance_publish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Publish Date'),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
      '#date_timezone' => drupal_get_user_timezone(),
      '#description' => $this->t('Publishing date for the maintenance page.'),
      '#default_value' => $this->get('maintenance_publish_date',
        ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
    ];

    $form['maintenance_group']['maintenance_unpublish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Unpublish Date'),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
      '#date_timezone' => drupal_get_user_timezone(),
      '#description' => $this->t('Unpublishing date for the maintenance page.'),
      '#default_value' => $this->get('maintenance_unpublish_date',
        ['time_format' => self::MAINTENANCE_TIME_FORMAT]),
    ];
  }
}
