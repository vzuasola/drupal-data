<?php

namespace Drupal\vip_modal\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * VIP configuration plugin.
 *
 * @WebcomposerConfigPlugin(
 *   id = "vip_content_config",
 *   route = {
 *     "title" = "VIP Configuration",
 *     "path" = "/admin/config/webcomposer/vip_modal/content",
 *   },
 *   menu = {
 *     "title" = "VIP Content Configuration",
 *     "description" = "VIP Content configuration",
 *     "parent" = "vip_modal.list",
 *   },
 * )
 */
class VipConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.vip_content_config'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['vip_settings_tab'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->generalConfig($form);
    $this->rewardsAndRecognitionSection($form);
    $this->levelCardSection($form);

    return $form;
  }

  /**
   * General Configuration for VIP.
   */
  private function generalConfig(array &$form) {
    $form['general_config_section'] = [
      '#type' => 'details',
      '#title' => $this->t('General Config'),
      '#collapsible' => TRUE,
      '#group' => 'vip_settings_tab',
    ];
    $form['general_config_section']['vip_home_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Home title'),
      '#default_value' => $this->get("vip_home_title") ?: '',
      '#translatable' => TRUE,
    ];
    $form['general_config_section']['vip_level_card_ribbon_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Level card ribbon title'),
      '#default_value' => $this->get("vip_level_card_ribbon_title") ?: '',
      '#translatable' => TRUE,
    ];
    $form['general_config_section']['vip_level_card_blurb'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Level card blurb'),
      '#default_value' => $this->get("vip_level_card_blurb") ?: '',
      '#translatable' => TRUE,
    ];
    $form['general_config_section']['vip_level_card_unlocked'] = [
      '#type' => 'textfield',
      '#title' => $this->t('VIP unlocked blurb'),
      '#default_value' => $this->get("vip_level_card_unlocked") ?: '',
      '#translatable' => TRUE,
    ];
  }

  /**
   * Rewards and Recognition Section.
   */
  private function rewardsAndRecognitionSection(array &$form) {
    $form['rewards_section'] = [
      '#type' => 'details',
      '#title' => $this->t('Rewards and Recognition'),
      '#collapsible' => TRUE,
      '#group' => 'vip_settings_tab',
    ];

    $form['rewards_section']['rewards_recognition_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Badge title'),
      '#default_value' => $this->get('rewards_recognition_title') ?: '',
      '#description' => $this->t('Rewards and Recognition badge title'),
      '#translatable' => TRUE,
    ];

    $dv = $this->get('rewards_recognition_content');
    $form['rewards_section']['rewards_recognition_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#default_value' => $dv['value'] ?: '',
      '#format' => $dv['format'],
      '#description' => $this->t('VIP rewards and recognition content'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * Level Cards Section.
   */
  private function levelCardSection(array &$form) {

    $vipConfig = \Drupal::config('webcomposer_config.vip_configuration')->get('vip_mapping_configuration');
    $vipLevels = explode(PHP_EOL, $vipConfig);

    foreach ($vipLevels as $configValue) {
      $vipKeys = explode('|', $configValue);
      $group = "$vipKeys[0]_level_card_section";

      $form[$group] = [
        '#type' => 'details',
        '#title' => "$vipKeys[0] Level Card",
        '#collapsible' => TRUE,
        '#group' => 'vip_settings_tab',
      ];

      $form[$group]["$vipKeys[0]_level_card_title"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Card title'),
        '#default_value' => $this->get("$vipKeys[0]_level_card_title") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]["$vipKeys[0]_level_card_link"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Card link'),
        '#default_value' => $this->get("$vipKeys[0]_level_card_link") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]["$vipKeys[0]_level_card_target"] = [
        '#type' => 'select',
        '#title' => $this->t('Link target'),
        '#default_value' => $this->get("$vipKeys[0]_level_card_target") ?: '',
        '#translatable' => TRUE,
        '#options' => [
          '_blank' => $this->t('New Window'),
          '_self' => $this->t('Same Window'),
          'window' => $this->t('Popup Window'),
          'modal' => $this->t('Modal'),
        ],
      ];

      $form[$group]['pre'] = [
        '#type' => 'details',
        '#title' => $this->t('Pre Login Content'),
        '#collapsible' => TRUE,
        '#open' => FALSE,
      ];

      $dv = $this->get("$vipKeys[0]_level_pre_content");
      $form[$group]['pre']["$vipKeys[0]_level_pre_content"] = [
        '#type' => 'text_format',
        '#title' => $this->t('Pre Login Content'),
        '#default_value' => $dv['value'] ?: '',
        '#format' => $dv['format'],
        '#translatable' => TRUE,
      ];

      $form[$group]['pre']["$vipKeys[0]_pre_button_label"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button label'),
        '#default_value' => $this->get("$vipKeys[0]_pre_button_label") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]['pre']["$vipKeys[0]_pre_button_link"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button link'),
        '#default_value' => $this->get("$vipKeys[0]_pre_button_link") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]['pre']["$vipKeys[0]_pre_button_target"] = [
        '#type' => 'select',
        '#title' => $this->t('Button link target'),
        '#default_value' => $this->get("$vipKeys[0]_pre_button_target") ?: '',
        '#translatable' => TRUE,
        '#options' => [
          '_blank' => $this->t('New Window'),
          '_self' => $this->t('Same Window'),
          'window' => $this->t('Popup Window'),
          'modal' => $this->t('Modal'),
        ],
      ];

      $form[$group]['post'] = [
        '#type' => 'details',
        '#title' => $this->t('Post Login Content'),
        '#collapsible' => TRUE,
        '#open' => FALSE,
      ];

      $dv = $this->get("$vipKeys[0]_level_post_description");
      $form[$group]['post']["$vipKeys[0]_level_post_description"] = [
        '#type' => 'text_format',
        '#title' => ($vipKeys[0] == 'bronze') ? $this->t('Unlocked Content') : $this->t('Locked Content'),
        '#default_value' => $dv['value'] ?: '',
        '#format' => $dv['format'],
        '#translatable' => TRUE,
      ];

      $dv = $this->get("$vipKeys[0]_current_level_content");
      $form[$group]['post']["$vipKeys[0]_current_level_content"] = [
        '#type' => 'text_format',
        '#title' => $this->t('Current Level Content'),
        '#default_value' => $dv['value'] ?: '',
        '#format' => $dv['format'],
        '#translatable' => TRUE,
      ];

      $dv = $this->get("$vipKeys[0]_level_unlocked_content");
      $form[$group]['post']["$vipKeys[0]_level_unlocked_content"] = [
        '#type' => 'text_format',
        '#title' => ($vipKeys[0] == 'bronze') ? $this->t('Blurb') : $this->t('Unlocked Content'),
        '#default_value' => $dv['value'] ?: '',
        '#format' => $dv['format'],
        '#translatable' => TRUE,
      ];

      $form[$group]['post']["$vipKeys[0]_post_button_label"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button label'),
        '#default_value' => $this->get("$vipKeys[0]_post_button_label") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]['post']["$vipKeys[0]_post_button_link"] = [
        '#type' => 'textfield',
        '#title' => $this->t('Button link'),
        '#default_value' => $this->get("$vipKeys[0]_post_button_link") ?: '',
        '#translatable' => TRUE,
      ];

      $form[$group]['post']["$vipKeys[0]_post_button_target"] = [
        '#type' => 'select',
        '#title' => $this->t('Button link target'),
        '#default_value' => $this->get("$vipKeys[0]_post_button_target") ?: '',
        '#translatable' => TRUE,
        '#options' => [
          '_blank' => $this->t('New Window'),
          '_self' => $this->t('Same Window'),
          'window' => $this->t('Popup Window'),
          'modal' => $this->t('Modal'),
        ],
      ];
    }
  }

}
