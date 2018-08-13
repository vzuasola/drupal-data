<?php

namespace Drupal\keno_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Configuration Form for Keno Configuration.
 */
class KenoConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['keno_config.keno_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'keno_config_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('keno_config.keno_configuration');

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Keno Configurations'),
    ];

    $form['lobby_tiles'] = [
      '#type' => 'details',
      '#title' => t('Lobby Tiles'),
      '#group' => 'advanced',
    ];

    $form['lobby_tiles']['lobby_tiles_alignment'] = [
      '#type' => 'select',
      '#title' => $this->t('Lobby Tiles Alignment'),
      '#options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
      ],
      '#default_value' => $config->get('lobby_tiles_alignment'),
    ];

     $form['games_button'] = [
      '#type' => 'details',
      '#title' => t('Game Button'),
      '#group' => 'virtual',
    ];

    $form['games_button']['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $config->get('play_text'),
      '#required' => TRUE,
    ];

    $form['games_button']['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('This text to display on game info link.'),
      '#default_value' => $config->get('game_info_text'),
      '#required' => TRUE,
    ];

    $form['games_button']['free_play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Free Play Text'),
      '#description' => $this->t('The text to display on Free Play Link.'),
      '#default_value' => $config->get('free_play_text'),
      '#required' => TRUE,
    ];

    $form['basic_page'] = [
      '#type' => 'details',
      '#title' => t('Basic Page'),
      '#group' => 'advanced',
    ];

    $form['basic_page']['basic_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Basic Page Background Image'),
      '#default_value' => $config->get('basic_page_background'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $pageListSortUrl = Url::fromUri('internal:/admin/structure/sort-page-list', []);
    $pageListSortLink = Link::fromTextAndUrl(t('this link'), $pageListSortUrl);

    $form['basic_page']['basic_page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Basic Page Titles'),
      '#default_value' => $config->get('basic_page_title'),
      '#description' => $this->t('For sorting Basic Pages in a Page List go to '. $pageListSortLink->toString() . '.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $kenoConfig = [
      'lobby_tiles_alignment',
      'keno_background',
      'basic_page_background',
      'basic_page_title',
      'balance_mapping_keno',
      'play_text',
      'game_info_text',
      'free_play_text'
    ];
    foreach ($kenoConfig as $keys) {
      if ($keys == 'keno_background') {
        $fid = $form_state->getValue('keno_background');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'keno_config', 'image', $fid[0]);

          $this->config('keno_config.keno_configuration')->set("keno_background_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('keno_config.keno_configuration')->set("keno_background_image_url", null);
        }
      }
      if ($keys == 'basic_page_background') {
        $fid = $form_state->getValue('basic_page_background');
        if ($fid) {
          $file = File::load($fid[0]);
          $file->setPermanent();
          $file->save();

          $file_usage = \Drupal::service('file.usage');
          $file_usage->add($file, 'keno_config', 'image', $fid[0]);

          $this->config('keno_config.keno_configuration')->set("basic_page_background_image_url", file_create_url($file->getFileUri()))->save();
        } else {
          $this->config('keno_config.keno_configuration')->set("basic_page_background_image_url", null);
        }
      }
      $this->config('keno_config.keno_configuration')->set($keys, $form_state->getValue($keys))->save();
    }
    parent::submitForm($form, $form_state);
  }
}
