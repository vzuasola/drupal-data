<?php

namespace Drupal\registration_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Opera Mini Configuration Plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "opera_mini_config_form",
 *   route = {
 *     "title" = "Opera Mini Configuration",
 *     "path" = "/admin/config/registration/opera_mini_configuration",
 *   },
 *   menu = {
 *     "title" = "Opera Mini Configuration",
 *     "description" = "Provides custom configuration for Opera Mini browser",
 *     "parent" = "registration_config.list",
 *     "weight" = 100
 *   },
 * )
 */

class OperaMiniConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['registration_config.opera_mini_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Opera Mini Configuration'),
    ];

    $this->extremeModeUserAlertConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function extremeModeUserAlertConfig(array &$form) {
    $form['extreme_mode_user_alert'] = [
      '#type' => 'details',
      '#title' => t('Extreme Mode Message'),
      '#group' => 'advanced',
    ];

    $form['extreme_mode_user_alert']['toggle'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Opera Mini Extreme Mode Alert'),
      '#description' => $this->t('Allow opera mini message to show for users with extreme mode on.'),
      '#default_value' => $this->get('toggle'),
    ];

    $form['extreme_mode_user_alert']['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Alert Text'),
      '#description' => $this->t('The text user will see once extreme mode on in Opera Mini browser.'),
      '#default_value' => $this->get('message'),
      '#required' => false,
      '#translatable' => true,
    ];

    $form['extreme_mode_user_alert']['user_agent'] = [
      '#type' => 'textarea',
      '#title' => $this->t('User Agents'),
      '#description' => $this->t('User Agents used for detection of extreme mode. Provide inputs per line.'),
      '#default_value' => $this->get('user_agent'),
      '#required' => true,
      '#translatable' => true,
    ];
  }
}
