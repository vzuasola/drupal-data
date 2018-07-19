<?php

namespace Drupal\webcomposer_mailer\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "webcomposer_mailer_config",
 *   route = {
 *     "title" = "Web Composer Mailer Configuration",
 *     "path" = "/admin/config/webcomposer/config/mailer_config",
 *   },
 *   menu = {
 *     "title" = "Mailer configuration",
 *     "description" = "Webcomposer Mail Configuration",
 *     "parent" = "mailer_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class MailerConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.mailer_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->mailerSettings($form);
    $this->antiSpamSettings($form);

    return $form;
  }

  /**
   *
   */
  private function mailerSettings(array &$form) {

    $form['settings'] = [
      '#type' => 'details',
      '#title' => t('Mailer Settings'),
      '#group' => 'advanced',
    ];

    $form['settings']['mail_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Mailer'),
      '#description' => $this->t('If checked will allow Drupal to send mail.'),
      '#default_value' => $this->get('mail_enable'),
    ];

    $form['settings']['mailer_success'] = [
      '#type' => 'textarea',
      '#title' => t('Generic success message'),
      '#default_value' => $this->get('mailer_success'),
      '#description' => 'Success message to show the user',
      '#rows' => 3
    ];

    $form['settings']['mailer_error'] = [
      '#type' => 'textarea',
      '#title' => t('Generic error message'),
      '#default_value' => $this->get('mailer_error'),
      '#description' => 'Error message to show the user.',
      '#rows' => 3
    ];
  }

  /**
   *
   */
  private function antiSpamSettings(array &$form) {

    $form['antispam'] = [
      '#type' => 'details',
      '#title' => t('Anti Spam Settings'),
      '#group' => 'advanced',
    ];

    $form['antispam']['antispam_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Anti Spam'),
      '#description' => $this->t('If checked will allow Anti spam feature.'),
      '#default_value' => $this->get('antispam_enable'),
    ];

    $form['antispam']['antispam_limit'] = [
      '#type' => 'number',
      '#title' => $this->t('Request Limit'),
      '#description' => $this->t('Maximum request limit per interval.'),
      '#default_value' => $this->get('antispam_limit'),
      '#required' => TRUE,
    ];

    $form['antispam']['antispam_interval'] = [
      '#type' => 'number',
      '#title' => $this->t('Time Interval'),
      '#description' => $this->t('Number of seconds in the time window.'),
      '#default_value' => $this->get('antispam_interval'),
      '#required' => TRUE,
    ];

    $form['antispam']['antispam_error'] = [
      '#type' => 'textarea',
      '#title' => t('Error message'),
      '#default_value' => $this->get('antispam_error'),
      '#description' => 'Message to show the user</br>Tokens: 
                        <strong>@limit</strong> (Request Limit) 
                        <strong>@interval</strong> (Time Interval).',
      '#rows' => 3,
    ];
  }
}