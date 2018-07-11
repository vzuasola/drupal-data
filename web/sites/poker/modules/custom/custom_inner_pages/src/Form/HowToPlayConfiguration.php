<?php

namespace Drupal\custom_inner_pages\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Avaya chat configuration class
 */
class HowToPlayConfiguration extends ConfigFormBase {
  /**
   * @inheritdoc
   */
  public function getFormId() {
    return 'how_to_play_form';
  }

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['custom_inner_pages.how_to_play_page'];
  }

  /**
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_inner_pages.how_to_play_page');

    $form['how_to_play_page_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->firstTab($form, $config);
    $this->secondTab($form, $config);
    $this->thirdTab($form, $config);

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $keys = [
      'first_tab_title',
      'first_tab_id',
      'first_tab_icon',
      'first_tab_icon_hover',
      'first_tab_content',
      'second_tab_title',
      'second_tab_id',
      'second_tab_icon',
      'second_tab_icon_hover',
      'second_tab_content',
      'third_tab_title',
      'third_tab_id',
      'third_tab_icon',
      'third_tab_icon_hover',
      'third_tab_content',
    ];

    foreach ($keys as $key) {
      if ($key == 'first_tab_icon' ||
          $key == 'first_tab_icon_hover' ||
          $key == 'second_tab_icon' ||
          $key == 'second_tab_icon_hover' ||
          $key == 'third_tab_icon' ||
          $key == 'third_tab_icon_hover' ) {
        $fid = $form_state->getValue($key);
        $file = File::load($fid[0]);
        $this->config('custom_inner_pages.how_to_play_page')->set("how_to_play", file_create_url($file->getFileUri()))->save();
      }

      $this->config('custom_inner_pages.how_to_play_page')->set($key, $form_state->getValue($key))->save();
    }

    parent::submitForm($form, $form_state);
  }

  private function firstTab(&$form, $config) {
    $form['first_tab'] = array(
      '#type' => 'details',
      '#title' => $this->t('First Tab'),
      '#collapsible' => TRUE,
      '#group' => 'how_to_play_page_tab'
    );

    $form['first_tab']['first_tab_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab Title'),
      '#description' => $this->t('Add Tab Title to How to play first tab'),
      '#default_value' => $config->get('first_tab_title'),
      '#required' => TRUE,
    );

    $form['first_tab']['first_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play first tab'),
      '#default_value' => $config->get('first_tab_title'),
      '#required' => TRUE,
    );

    $form['first_tab']['first_tab_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('first_tab_icon'),
      '#required' => TRUE,
    ];

    $form['first_tab']['first_tab_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('first_tab_icon_hover'),
      '#required' => TRUE,
    ];

    $firstTabContent = $config->get('first_tab_content');
    $form['first_tab']['first_tab_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as short content of the tab.'),
      '#default_value' => $firstTabContent['value'],
      '#format' => $firstTabContent['format'],
      '#required' => TRUE,
    );
  }

  private function secondTab(&$form, $config) {
    $form['second_tab'] = array(
      '#type' => 'details',
      '#title' => $this->t('Second Tab'),
      '#collapsible' => TRUE,
      '#group' => 'how_to_play_page_tab'
    );

    $form['second_tab']['second_tab_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab Title'),
      '#description' => $this->t('Add Tab Title to How to play second tab'),
      '#default_value' => $config->get('second_tab_title'),
      '#required' => TRUE,
    );

    $form['second_tab']['second_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play second tab'),
      '#default_value' => $config->get('second_tab_title'),
      '#required' => TRUE,
    );

    $form['second_tab']['second_tab_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('second_tab_icon'),
      '#required' => TRUE,
    ];

    $form['second_tab']['second_tab_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('second_tab_icon_hover'),
      '#required' => TRUE,
    ];

    $secondTabContent = $config->get('second_tab_content');
    $form['second_tab']['second_tab_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as short content of the tab.'),
      '#default_value' => $secondTabContent['value'],
      '#format' => $secondTabContent['format'],
      '#required' => TRUE,
    );
  }

  private function thirdTab(&$form, $config) {
    $form['third_tab'] = array(
      '#type' => 'details',
      '#title' => $this->t('Third Tab'),
      '#collapsible' => TRUE,
      '#group' => 'how_to_play_page_tab'
    );

    $form['third_tab']['third_tab_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab Title'),
      '#description' => $this->t('Add Tab Title to How to play third tab'),
      '#default_value' => $config->get('third_tab_title'),
      '#required' => TRUE,
    );

    $form['third_tab']['third_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play third tab'),
      '#default_value' => $config->get('third_tab_title'),
      '#required' => TRUE,
    );

    $form['third_tab']['third_tab_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('third_tab_icon'),
      '#required' => TRUE,
    ];

    $form['third_tab']['third_tab_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('third_tab_icon_hover'),
      '#required' => TRUE,
    ];

    $thirdTabContent = $config->get('third_tab_content');
    $form['third_tab']['third_tab_content'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#description' => $this->t('The text that will be displayed as short content of the tab.'),
      '#default_value' => $thirdTabContent['value'],
      '#format' => $thirdTabContent['format'],
      '#required' => TRUE,
    );
  }
}
