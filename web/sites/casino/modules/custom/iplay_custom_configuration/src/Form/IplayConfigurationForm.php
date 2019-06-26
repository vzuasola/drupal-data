<?php

namespace Drupal\iplay_custom_configuration\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Iplay custom config form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "iplay_config_form",
 *   route = {
 *     "title" = "iPlay Custom Configuration",
 *     "path" = "/admin/iplay/config",
 *   },
 *   menu = {
 *     "title" = "iPlay Custom Configuration",
 *     "description" = "Configure custom iPlay configuration",
 *     "parent" = "casino_games.admin_settings",
 *     "weight" = -5
 *   },
 * )
 */
class IplayConfigurationForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['casino_games.iplay_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['iplay_configuration_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Settings'),
    ];

    $this->headerNavLinksSection($form);
    $this->iplayHeaderSettingsOverride($form);

    return $form;
  }

  private function headerNavLinksSection(&$form) {
    $form['header_links_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Header Navigation Links'),
      '#collapsible' => TRUE,
      '#group' => 'ipaly_configuration_tab'
    ];
    $form['header_links_group']['promotion_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Text'),
      '#default_value' => $this->get('promotion_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['header_links_group']['promotion_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promotion Link'),
      '#description' => $this->t('Add redirection to  Promotions page'),
      '#default_value' => $this->get('promotion_link'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['header_links_group']['contact_us_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Text'),
      '#default_value' => $this->get('contact_us_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['header_links_group']['contact_us_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Us Link'),
      '#description' => $this->t('Add link to the Contact Us page.'),
      '#default_value' => $this->get('contact_us_link'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['header_links_group']['live_chat_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Text'),
      '#default_value' => $this->get('live_chat_text'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
    $form['header_links_group']['live_chat_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Live Chat Link'),
      '#default_value' => $this->get('live_chat_link'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
  private function iplayHeaderSettingsOverride(&$form) {
    $form['header_config_group'] = array(
      '#type' => 'details',
      '#title' => $this->t('Header Settings Override'),
      '#description' => $this->t(
        '<br/><i><b>NOTE:</b>All empty fields will use the original field under webcomposer header configurations</i>'
      ),
      '#collapsible' => TRUE,
      '#group' => 'ipaly_configuration_tab',
    );

    $form['header_config_group']['registration'] = [
      '#type' => 'details',
      '#title' => $this->t('Registration'),
      '#description' => $this->t('Registration header config override for Iplay.'),
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $form['header_config_group']['registration']['iplay_header_override_reg_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Join Now Button Text'),
      '#description' => $this->t('This field will be used as the join now link for iplay site.'),
      '#default_value' => $this->get('iplay_header_override_reg_label'),
      '#required' => FALSE,
      '#translatable' => true
    );

    $form['header_config_group']['registration']['iplay_header_override_reg_link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Registration Link'),
      '#description' => $this->t('This field will be used as the join now link for iplay site.'),
      '#default_value' => $this->get('iplay_header_override_reg_link'),
      '#required' => FALSE,
      '#translatable' => true
    );
  }
}
