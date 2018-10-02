<?php
namespace Drupal\exchange_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Exchange Configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "exchange_config_lobby",
 *   route = {
 *     "title" = "Exchange Lobby Tiles Configuration",
 *     "path" = "/admin/config/exchange/exchangeconfig",
 *   },
 *   menu = {
 *     "title" = "Exchange Lobby Tiles Configuration",
 *     "description" = "Exchange Lobby Tiles Configuration",
 *     "parent" = "exchange_config.exchange_config_list",
 *     "weight" = 1
 *   },
 * )
 */
class ExchangeConfigForm extends FormBase {
  /**
   * @inheritdoc
   */
    const EXCHANGE_MENU = [
        'trust_element' => 'Trust Element',
        'lobby_tiles' => 'Lobby Tiles',
        'exchange_blocking_country' => 'Blocking Country',
        'blocking_currency' => 'Blocking Currency',
        'exchange_configuration_mobile' => 'Mobile Site URL',
    ];

  protected function getEditableConfigNames() {
    return ['exchange_config.exchange_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['exchange_config_lobby'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Exchange Configurations'),
    ];

    $this->generalConfig($form);
    foreach (self::EXCHANGE_MENU as $key => $value) {
      $this->gpiContentTab($form[$key], $key, $value);
    }

    return $form;
  }

  private function generalConfig(&$form) {
    $form['gen_config'] = [
      '#type' => 'details',
      '#title' => $this->t('General Configuration'),
      '#collapsible' => TRUE,
      '#group' => 'exchange_config_lobby'
    ];

    $form['gen_config']['file_image_exchange_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background'),
      '#default_value' => $this->get('file_image_exchange_background'),
      '#upload_location' => 'public://',
      '#description' =>  $this->t('Exchange background'),
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];
  }

  private function gpiContentTab(&$form, $key, $value) {
    $form = [
      '#type' => 'details',
      '#title' => $this->t($value),
      '#collapsible' => TRUE,
      '#group' => 'exchange_config_lobby'
    ];
   if($key == 'trust_element') {
      $form['trust_element_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $this->get('trust_element_title'),
        '#required' => false,
        '#translatable' => true,
      ];

      $form['trust_element_content'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Content'),
        '#description' => $this->t('Content'),
        '#default_value' => $this->get('trust_element_content')['value'],
        '#required' => false,
        '#translatable' => TRUE,
      ];
    }
    if($key == 'lobby_tiles') {
      $form['lobby_tiles_alignment'] = [
        '#type' => 'select',
        '#title' => $this->t('Lobby Tiles Alignment'),
        '#default_value' => $this->get('lobby_tiles_alignment'),
        '#options' => [
          'left' => 'Left',
          'center' => 'Center',
          'right' => 'Right',
        ],
        '#required' => false,
        '#translatable' => true,
      ];

    }
    if($key == 'exchange_blocking_country') {
      $form['blocking_country_not_found_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $this->get('blocking_country_not_found_title'),
        '#required' => false,
        '#translatable' => true,
      ];

      $form['blocking_country_not_found_image'] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Image'),
        '#default_value' => $this->get('blocking_country_not_found_image'),
        '#upload_location' => 'public://',
        '#required' => false,
        '#translatable' => true,
        '#upload_validators' => [
          'file_validate_extensions' => ['gif png jpg jpeg'],
        ],
      ];

      $form['blocking_country_not_found_content'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Content'),
        '#description' => $this->t('Content'),
        '#default_value' => $this->get('blocking_country_not_found_content')['value'],
        '#required' => false,
        '#translatable' => TRUE,
      ];
    }
    if($key == 'blocking_currency') {
      $form['blocking_currency_not_found_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => $this->get('blocking_currency_not_found_title'),
        '#required' => false,
        '#translatable' => true,
      ];

      $form['blocking_currency_not_found_image'] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Image'),
        '#default_value' => $this->get('blocking_currency_not_found_image'),
        '#upload_location' => 'public://',
        '#required' => false,
        '#translatable' => true,
        '#upload_validators' => [
          'file_validate_extensions' => ['gif png jpg jpeg'],
        ],
      ];

      $form['blocking_currency_not_found_content'] = [
        '#type' => 'text_format',
        '#title' => $this->t('Content'),
        '#description' => $this->t('Content'),
        '#default_value' => $this->get('blocking_currency_not_found_content')['value'],
        '#required' => false,
        '#translatable' => TRUE,
      ];
    }
    if($key == 'exchange_configuration_mobile') {
      $form['base_url'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Mobile Site Url'),
        '#default_value' => $this->get('base_url'),
        '#required' => true,
        '#translatable' => true,
      ];
    } 
  }
}
