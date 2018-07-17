<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_header",
 *   route = {
 *     "title" = "Header Configuration",
 *     "path" = "/admin/config/jamboree/header_configuration",
 *   },
 *   menu = {
 *     "title" = "Header Configuration",
 *     "description" = "Provides jamboree header configuration",
 *     "parent" = "jamboree_config.jamboree_config",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeHeaderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.header_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionNotificationStrip($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionNotificationStrip(array &$form) {
    $form['footer'] = [
      '#type' => 'details',
      '#title' => t('Notification Strip'),
      '#group' => 'advanced',
    ];

     $form['footer']['notification_strip'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Notification Strip',
      '#description' => $this->t('Show/hide Notification Strip".'),
      '#default_value' => $this->get('notification_strip'),
      '#translatable' => TRUE,
    ];

    $default_notification_strip = $this->get('notification_strip_content');
    $form['footer']['notification_strip_content'] = [
      '#type' => 'text_format',
      '#title' => t('Notification Strip Content'),
      '#default_value' => $default_notification_strip['value'],
      '#description' => $this->t('NOTE: Notifacation Strip content must not be empty and announcement must be enabled to show announcement.'),
      '#format' => $default_notification_strip['format'],
      '#states' => [
        'invisible' => [
          'input[name="notification_strip"]' => ['checked' => FALSE],
        ],
      ],
      '#translatable' => TRUE,
    ];

    $form['footer']['notification_strip_scheduler'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Notification Strip Scheduler',
      '#default_value' => $this->get('notification_strip_scheduler'),
      '#translatable' => TRUE,
      '#states' => [
        'invisible' => [
          'input[name="notification_strip"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['footer']['scheduler_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Notification Strip Scheduler'),
      '#states' => [
        'invisible' => [
          'input[name="notification_strip_scheduler"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $startDate = $this->get('notif_strip_start_date');
    if ($startDate) {
        $startDate = DrupalDateTime::createFromTimestamp(date($startDate));
    }
    $form['footer']['scheduler_fieldset']['notif_strip_start_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Start Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $startDate,
      '#translatable' => TRUE,
    ];

    $endDate = $this->get('notif_strip_end_date');
    if ($endDate) {
        $endDate = DrupalDateTime::createFromTimestamp(date($endDate));
    }
    $form['footer']['scheduler_fieldset']['notif_strip_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $endDate,
      '#translatable' => TRUE,
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'notification_strip',
      'notification_strip_content',
      'notification_strip_scheduler',
      'notif_strip_start_date',
      'notif_strip_end_date',
    ];

    foreach ($keys as $key) {
        switch ($key) {
            case 'notif_strip_start_date':
            case 'notif_strip_end_date':
                $data[$key] = strtotime($form_state->getvalue($key));
                break;
            default:
                $data[$key] = $form_state->getValue($key);
                break;
        }
    }

    $this->save($data);
  }
}
