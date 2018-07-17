<?php

namespace Drupal\custom_inner_pages\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * How to Play form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "how_to_play_form",
 *   route = {
 *     "title" = "How to Play Configuration Form",
 *     "path" = "/admin/config/poker/custom-inner-pages/how-to-play",
 *   },
 *   menu = {
 *     "title" = "How to Play Page Configuration",
 *     "description" = "Provides configuration for How to Play Page",
 *     "parent" = "custom_inner_pages.list",
 *     "weight" = -5
 *   },
 * )
 */
class HowToPlayConfiguration extends FormBase {

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['poker_config.how_to_play_page'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $config = $this->config('poker_config.how_to_play_page');

    $form['how_to_play_page_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->generalConfig($form, $config);
    $this->firstTab($form, $config);
    $this->secondTab($form, $config);
    $this->thirdTab($form, $config);

    return $form;
  }


  private function generalConfig(&$form, $config) {
    $form['gen_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('General Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'how_to_play_page_tab'
    );

    $form['gen_config']['page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Page Title'),
      '#description' => $this->t('This will appear in browser page tab title'),
      '#default_value' => $config->get('page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    );
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
      '#translatable' => TRUE,
    );

    $form['first_tab']['first_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play first tab'),
      '#default_value' => $config->get('first_tab_id'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
    );

    $form['second_tab']['second_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play second tab'),
      '#default_value' => $config->get('second_tab_id'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
    );

    $form['third_tab']['third_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on How to play third tab'),
      '#default_value' => $config->get('third_tab_id'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#translatable' => TRUE,
    );
  }
}
