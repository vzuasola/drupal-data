<?php

namespace Drupal\poker_vip_page\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * VIP Page form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "vip_page_form",
 *   route = {
 *     "title" = "VIP Page Configuration Form",
 *     "path" = "/admin/config/poker/custom-inner-pages/vip-page",
 *   },
 *   menu = {
 *     "title" = "Poker VIP Page Configuration",
 *     "description" = "Provides configuration for Poker VIP Page",
 *     "parent" = "poker_vip_page.list",
 *     "weight" = -5
 *   },
 * )
 */
class VipPageConfiguration extends FormBase {

  /**
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['poker_config.vip_page'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $config = $this->config('poker_config.vip_page');

    $form['vip_page_tab'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    );

    $this->generalConfig($form, $config);
    $this->firstTab($form, $config);
    $this->secondTab($form, $config);

    return $form;
  }

  private function generalConfig(&$form, $config) {
    $form['gen_config'] = array(
      '#type' => 'details',
      '#title' => $this->t('General Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'vip_page_tab'
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
      '#group' => 'vip_page_tab'
    );

    $form['first_tab']['first_tab_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab Title'),
      '#description' => $this->t('Add Tab Title to VIP Page first tab'),
      '#default_value' => $config->get('first_tab_title'),
      '#translatable' => TRUE,
    );

    $form['first_tab']['first_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on VIP Page first tab'),
      '#default_value' => $config->get('first_tab_id'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    );

    $form['first_tab']['file_image_first_tab_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('file_image_first_tab_icon'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['first_tab']['file_image_first_tab_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('file_image_first_tab_icon_hover'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
      '#group' => 'vip_page_tab'
    );

    $form['second_tab']['second_tab_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab Title'),
      '#description' => $this->t('Add Tab Title to VIP Page second tab'),
      '#default_value' => $config->get('second_tab_title'),
      '#translatable' => TRUE,
    );

    $form['second_tab']['second_tab_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tab ID'),
      '#description' => $this->t('Add Tab ID of secondary menu on VIP Page second tab'),
      '#default_value' => $config->get('second_tab_id'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    );

    $form['second_tab']['file_image_second_tab_icon'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('file_image_second_tab_icon'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['second_tab']['file_image_second_tab_icon_hover'] = [
      '#type' => 'managed_file',
      '#title' => t('Tab Highlighted Icon'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
      ],
      '#default_value' => $config->get('file_image_second_tab_icon_hover'),
      '#required' => TRUE,
      '#translatable' => TRUE,
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
}
