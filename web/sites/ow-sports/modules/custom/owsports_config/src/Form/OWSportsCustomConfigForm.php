<?php

namespace Drupal\owsports_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Datetime\DrupalDateTime;

class OWSportsCustomConfigForm extends ConfigFormBase {

  const MAINTENANCE_TIMEZONE = 'UTC';

  const MAINTENANCE_TIME_FORMAT = 'm/d/Y H:i:s';

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['owsports_config.owsports_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'owsports_config.owsports_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('owsports_config.owsports_configuration');

    $form['owsports_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $form['owsports_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('General Config'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['owsports_config_group']['transaction_subdomain'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Transaction Subdomain'),
      '#description' => $this->t('transactions subdomain.'),
      '#default_value' => $config->get('transaction_subdomain'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['language_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Language Mapping'),
      '#description' => $this->t('Language conversion from Drupal to OneWorks language.'),
      '#default_value' => $config->get('language_mapping'),
      '#required' => TRUE,
    ];

    $form['owsports_config_group']['url_param'] = [
      '#type' => 'textarea',
      '#title' => $this->t('iFrame URL parameters'),
      '#description' => $this->t('query parameters for iFrame. To add use key=value, keyword|key=value'),
      '#default_value' => $config->get('url_param'),
    ];

    $form['owsports_config_group']['right_side_block'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide Right Side Block'),
      '#default_value' => $config->get('right_side_block'),
      '#description' => $this->t('Enable this feature to hide the right side block below 1330px and lower width of screen.'),
    ];

    $form['jackpotbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Jackpot Bet'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['jackpotbet_config_group']['colossus_login_lightbox'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Launch login lightbox on pre-login'),
      '#default_value' => $config->get('colossus_login_lightbox'),
    ];

    $form['jackpotbet_config_group']['colossus_pre_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-login'),
      '#description' => $this->t('Pre Login URI.'),
      '#default_value' => $config->get('colossus_pre_uri'),
      '#required' => TRUE,
    ];

    $form['jackpotbet_config_group']['colossus_post_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-login'),
      '#description' => $this->t('Post Login URI.'),
      '#default_value' => $config->get('colossus_post_uri'),
      '#required' => TRUE,
    ];

    $form['asia_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Asia Template (Default)'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['asia_config_group']['pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('pre_login_uri'),
      '#required' => TRUE,
    ];

    $form['asia_config_group']['post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('post_login_uri'),
      '#required' => TRUE,
    ];

    $form['asia_config_group']['how_to_bet_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How to bet URI'),
      '#default_value' => $config->get('how_to_bet_uri'),
    ];

    $form['euro_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Euro Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['euro_config_group']['euro_default_asia'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Asia template as default'),
      '#default_value' => $config->get('euro_default_asia')
    ];

    $form['euro_config_group']['euro_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('euro_pre_login_uri')
    ];

    $form['euro_config_group']['euro_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('euro_post_login_uri'),
    ];

    $form['euro_config_group']['euro_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Language'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=1" to the query string.'),
      '#default_value' => $config->get('euro_template'),
    ];

    $form['singbet_config_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Singbet Template'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['singbet_config_group']['singbet_default_asia'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use Asia template as default'),
      '#default_value' => $config->get('singbet_default_asia')
    ];

    $form['singbet_config_group']['singbet_pre_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pre-Login URI'),
      '#description' => $this->t('URI used for the Pre-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_pre_login_uri'),
    ];

    $form['singbet_config_group']['singbet_post_login_uri'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post-Login URI'),
      '#description' => $this->t('URI used for the Post-login state for the iFrame.'),
      '#default_value' => $config->get('singbet_post_login_uri'),
    ];

    $form['singbet_config_group']['singbet_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Supported Language'),
      '#description' => $this->t('Language that uses skin template. This will add "webskin=2" to the query string.'),
      '#default_value' => $config->get('singbet_template'),
    ];

    $form['maintenance_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Maintenance Config'),
      '#collapsible' => TRUE,
      '#group' => 'owsports_settings_tab',
    ];

    $form['maintenance_group']['maintenance_feature'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Soft Maintenance Page Status'),
      '#description' => $this->t('Enable this feature to show the soft maintenance page behaviour in the frontend.'),
      '#default_value' => $config->get('maintenance_feature'),
    ];

    $form['maintenance_group']['file_image_maintenance'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Maintenance Image'),
      '#default_value' => $config->get('file_image_maintenance'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['maintenance_group']['maintenance_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Maintenance Content'),
      '#description' => $this->t('Maintenance blurb content to display.'),
      '#default_value' => $config->get('maintenance_content')['value'],
      '#format' => $config->get('maintenance_content')['format'],
    ];

    $form['maintenance_group']['maintenance_publish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Publish Date'),
      '#description' => $this->t('Publishing date for the maintenance page.'),
      '#default_value' => $this->createTimestamp($config->get('maintenance_publish_date')),
      '#date_timezone' => drupal_get_user_timezone(),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
    ];

    $form['maintenance_group']['maintenance_unpublish_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Unpublish Date'),
      '#description' => $this->t('Unpublishing date for the maintenance page.'),
      '#default_value' => $this->createTimestamp($config->get('maintenance_unpublish_date')),
      '#date_timezone' => drupal_get_user_timezone(),
      '#format' => self::MAINTENANCE_TIME_FORMAT,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * setting and converting utc to locale timezone if set
   * referenced from https://www.drupal.org/node/1834108
   */
  private function createTimestamp($date) {
    if (isset($date)) {
      $date = new DrupalDateTime($date, self::MAINTENANCE_TIMEZONE);
      $dateConverted = $date->setTimezone(new \DateTimeZone(drupal_get_user_timezone()));
      return $dateConverted;
    }

    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $publishDate = $form_state->getValue('maintenance_publish_date')
      ? strtotime($form_state->getValue('maintenance_publish_date')->format(self::MAINTENANCE_TIME_FORMAT))
      : '';
    $unpublishDate = $form_state->getValue('maintenance_unpublish_date')
      ? strtotime($form_state->getValue('maintenance_unpublish_date')->format(self::MAINTENANCE_TIME_FORMAT))
      : '';

    if ($publishDate && !$unpublishDate) {
      $form_state->setErrorByName('maintenance_unpublish_date',
        t('please add unpublish date for maintenance as well.'));
    }

    if (!$publishDate && $unpublishDate) {
      $form_state->setErrorByName('maintenance_publish_date',
        t('please add publish date for maintenance as well.'));
    }

    if ($unpublishDate && $unpublishDate < $publishDate) {
      $form_state->setErrorByName('maintenance_unpublish_date',
        t('Unpublish date for maintenance should be greater than the publish date.'));
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'how_to_bet_uri',
      'transaction_subdomain',
      'pre_login_uri',
      'post_login_uri',
      'language_mapping',
      'euro_default_asia',
      'euro_template',
      'euro_pre_login_uri',
      'euro_post_login_uri',
      'euro_switch_redirect',
      'singbet_default_asia',
      'singbet_pre_login_uri',
      'singbet_post_login_uri',
      'singbet_template',
      'colossus_pre_uri',
      'colossus_post_uri',
      'colossus_login_lightbox',
      'url_param',
      'right_side_block',
      'maintenance_feature',
      'maintenance_content',
      'maintenance_publish_date',
      'maintenance_unpublish_date',
      'file_image_maintenance',
    ];

    foreach ($keys as $key) {
      if ($key == 'maintenance_publish_date' && !empty($form_state->getValue('maintenance_publish_date'))) {
        // converting datetime to utc time to match the server time
        $publishDateValue = format_date(strtotime($form_state->getValue($key)->format(self::MAINTENANCE_TIME_FORMAT)),
          'custom',
          self::MAINTENANCE_TIME_FORMAT,
          self::MAINTENANCE_TIMEZONE);
        $this->config('owsports_config.owsports_configuration')
        ->set('maintenance_publish_date', $publishDateValue)
        ->save();
        continue;
      }

      if ($key == 'maintenance_unpublish_date' && !empty($form_state->getValue('maintenance_unpublish_date'))) {
        // converting datetime to utc time to match the server time
        $unpublishDateValue = format_date(strtotime($form_state->getValue($key)->format(self::MAINTENANCE_TIME_FORMAT)),
          'custom',
          self::MAINTENANCE_TIME_FORMAT,
          self::MAINTENANCE_TIMEZONE);
        $this->config('owsports_config.owsports_configuration')
        ->set('maintenance_unpublish_date', $unpublishDateValue)
        ->save();
        continue;
      }

      if ($key == 'file_image_maintenance') {
        $fid = $form_state->getValue($key);
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();
          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'ow-sports', 'image', $fid[0]);

          $this->config('owsports_config.owsports_configuration')
          ->set("file_image_maintenance_url", file_create_url($file->getFileUri()))
          ->save();
        }
      }
      $this->config('owsports_config.owsports_configuration')
      ->set($key, $form_state->getValue($key))
      ->save();
    }

    parent::submitForm($form, $form_state);
  }

}
