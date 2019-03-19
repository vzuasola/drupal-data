<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "zipang_header",
 *   route = {
 *     "title" = "Header Configuration",
 *     "path" = "/admin/config/zipang/header_configuration",
 *   },
 *   menu = {
 *     "title" = "Header Configuration",
 *     "description" = "Provides zipang header configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangHeaderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.header_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionLogo($form);
    $this->sectionNotificationStrip($form);
    $this->sectionAccount($form);

    return $form;
  }


  private function sectionLogo(array &$form) {
    $form['logo'] = [
      '#type' => 'details',
      '#title' => t('Logo'),
      '#group' => 'advanced',
    ];

    $form['logo']['logo_tooltip'] = [
      '#type' => 'textfield',
      '#title' => t('Logo Tooltip'),
      '#default_value' => $this->get('logo_tooltip'),
      '#translatable' => TRUE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function sectionNotificationStrip(array &$form) {
    $form['notif_strip'] = [
      '#type' => 'details',
      '#title' => t('Notification Strip'),
      '#group' => 'advanced',
    ];

     $form['notif_strip']['notification_strip'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Notification Strip',
      '#description' => $this->t('Show/hide Notification Strip".'),
      '#default_value' => $this->get('notification_strip'),
      '#translatable' => TRUE,
    ];

    $default_notification_strip = $this->get('notification_strip_content');
    $form['notif_strip']['notification_strip_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Notification Strip Content'),
      '#default_value' => $default_notification_strip['value'],
      '#format' => $default_notification_strip['format'],
      '#states' => [
        'invisible' => [
          'input[name="notification_strip"]' => ['checked' => FALSE],
        ],
      ],
      '#translatable' => TRUE,
    ];

    $form['notif_strip']['notification_platform'] = [
      '#type' => 'select',
      '#title' => $this->t('Platorm'),
      '#options' => [
        'both' => $this->t('Both'),
        'mobile' => $this->t('Mobile'),
        'desktop' => $this->t('Desktop'),
      ],
      '#default_value' => $this->get('notification_platform'),
      '#translatable' => TRUE,
      '#states' => [
        'invisible' => [
          'input[name="notification_strip"]' => ['checked' => FALSE],
        ],
      ],
    ];

    $form['notif_strip']['notification_strip_scheduler'] = [
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

    $form['notif_strip']['scheduler_fieldset'] = [
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
    $form['notif_strip']['scheduler_fieldset']['notif_strip_start_date'] = [
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
    $form['notif_strip']['scheduler_fieldset']['notif_strip_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $endDate,
      '#translatable' => TRUE,
    ];
  }

  private function sectionAccount(array &$form) {
    $form['account'] = [
      '#type' => 'details',
      '#title' => t('Account'),
      '#group' => 'advanced',
    ];

    $form['account']['user_id_label'] = [
      '#type' => 'textfield',
      '#title' => t('User ID Label.'),
      '#default_value' => $this->get('user_id_label'),
      '#translatable' => TRUE,
    ];

    $form['account']['balance_label'] = [
      '#type' => 'textfield',
      '#title' => t('balance Label.'),
      '#default_value' => $this->get('balance_label'),
      '#translatable' => TRUE,
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'logo_tooltip',
      'notification_strip',
      'notification_strip_content',
      'notification_platform',
      'notification_strip_scheduler',
      'notif_strip_start_date',
      'notif_strip_end_date',
      'user_id_label',
      'balance_label',
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
