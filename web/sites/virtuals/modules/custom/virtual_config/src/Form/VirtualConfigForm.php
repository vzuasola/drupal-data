<?php
namespace Drupal\virtual_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Virtual Config Form
 *
 * @WebcomposerConfigPlugin(
 *   id = "virtual_config_form",
 *   route = {
 *     "title" = "Virtuals Configuration",
 *     "path" = "/admin/config/virtual/virtualconfig",
 *   },
 *   menu = {
 *     "title" = "Virtuals Configuration",
 *     "description" = "Virtuals Configuration",
 *     "parent" = "virtual_config.virtual_config_list",
 *     "weight" = 1
 *   },
 * )
 */
class VirtualConfigForm extends FormBase {
 /**
   * @inheritdoc
   */

  protected function getEditableConfigNames() {
    return ['virtual_config.virtual_configuration'];
  }

  /**
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['virtual_config_form'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];
    $this->mobileSiteTab($form);
    $this->gameButtonTab($form);
    $this->basicPageTab($form);

    return $form;
  }

  private function mobileSiteTab(&$form) {
    $form['virtual_configuration_mobile'] = [
      '#type' => 'details',
      '#title' => $this->t('Mobile Site Url'),
      '#collapsible' => true,
      '#group' => 'virtual_config_form'
    ];

    $form['virtual_configuration_mobile']['base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mobile Site Url'),
      '#description' => $this->t('Mobile Site Url'),
      '#default_value' => $this->get('base_url'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['virtual_configuration_mobile']['product_name_seo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Name in Canonical'),
      '#description' => $this->t('Product Name in Canonical'),
      '#default_value' => $this->get('product_name_seo'),
      '#required' => true,
      '#translatable' => true,
    ];

  }

  private function gameButtonTab(&$form) {
    $form['games_button'] = [
      '#type' => 'details',
      '#title' => $this->t('Game Button'),
      '#collapsible' => TRUE,
      '#group' => 'virtual_config_form'
    ];

    $form['games_button']['play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Play Now Button Text'),
      '#description' => $this->t('The text to display on play button.'),
      '#default_value' => $this->get('play_text'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['games_button']['game_info_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Info Link Text'),
      '#description' => $this->t('This text to display on game info link.'),
      '#default_value' => $this->get('game_info_text'),
      '#required' => true,
      '#translatable' => true,
    ];

    $form['games_button']['free_play_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Free Play Text'),
      '#description' => $this->t('The text to display on Free Play Link.'),
      '#default_value' => $this->get('free_play_text'),
      '#required' => false,
      '#translatable' => true,
    ];

  }

  private function basicPageTab(&$form) {
    $form['basic_page'] = [
      '#type' => 'details',
      '#title' => $this->t('Basic page'),
      '#collapsible' => true,
      '#group' => 'virtual_config_form'
    ];

    $form['basic_page']['virtuals_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Virtuals Background'),
      '#default_value' => $this->get('virtuals_background'),
      '#upload_location' => 'public://',
      '#description' =>  $this->t('Lobby tiles background'),
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $form['basic_page']['file_image_basic_page_background'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Basic Page Background Image'),
      '#default_value' => $this->get('file_image_basic_page_background'),
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
      '#description' => $this->t('For sorting Basic Pages in a Page List go to '. $pageListSortLink->toString() . '.'),
      '#default_value' => $this->get('basic_page_title'),
      '#required' => true,
      '#translatable' => true,
    ];
  }
}
