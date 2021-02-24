<?php

namespace Drupal\lucky_baby_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "lucky_baby_header",
 *   route = {
 *     "title" = "Header Configuration",
 *     "path" = "/admin/config/lucky_baby/header_configuration",
 *   },
 *   menu = {
 *     "title" = "Header Configuration",
 *     "description" = "Provides lucky_baby header configuration",
 *     "parent" = "lucky_baby_config.lucky_baby_config",
 *     "weight" = 30
 *   },
 * )
 */
class LuckyBabyHeaderForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lucky_baby_config.header_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Header Configuration'),
    ];

    $this->sectionLogo($form);
    $this->sectionNotificationStrip($form);
    $this->sectionAccount($form);
    $this->sectionBalance($form);

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
      '#title' => t('User ID Label'),
      '#default_value' => $this->get('user_id_label'),
      '#translatable' => TRUE,
    ];

    $form['account']['balance_label'] = [
      '#type' => 'textfield',
      '#title' => t('Balance Label'),
      '#default_value' => $this->get('balance_label'),
      '#translatable' => TRUE,
    ];

    $form['account']['balance_error_message'] = [
      '#type' => 'textfield',
      '#title' => t('Check Balance Error Retrieving Message'),
      '#default_value' => $this->get('balance_error_message'),
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function sectionBalance(array &$form) {

    $form['balance_group'] = [
      '#type' => 'details',
      '#title' => 'Balance',
      '#group' => 'advanced',
    ];

    $form['balance_group']['lucky_baby_total_balance_label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Total Balance Label.'),
      '#description' => $this->t('The label for the total balance'),
      '#default_value' => $this->get('lucky_baby_total_balance_label'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['balance_group']['lucky_baby_balance_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Product Balance Mapping'),
      '#description' => $this->t('Provide a product mapping that will show up below the username'),
      '#description' => $this->t("Provide a product mapping that will show up below the username
        <br><br>
        <b>Format:</b>
        <br>
        WALLET ID|LABEL|PORTAL_ID
        <br><br>
        <b>Example:</b>
        <br>
        7|Casino|RMB,USD,KRW
        <br><br>
      "),
      '#default_value' => $this->get('lucky_baby_balance_mapping'),
      '#translatable' => TRUE,
    ];

    $form['balance_group']['lucky_baby_balance_error_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Balance Error Message.'),
      '#description' => $this->t('Balance Error Message.'),
      '#default_value' => $this->get('lucky_baby_balance_error_text'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['balance_group']['lucky_baby_balance_error_text_product'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Product Balance Error Message'),
      '#description' => $this->t('Error message for the per product balance'),
      '#default_value' => $this->get('lucky_baby_balance_error_text_product'),
      '#translatable' => TRUE,
      '#required' => TRUE,
    ];

    $form['balance_group']['lucky_baby_balance_label_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Balances Label Mapping'),
      '#description' => $this->t('Labels and ordering for the balance breakdown'),
      '#default_value' => $this->get('lucky_baby_balance_label_mapping'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    // $form['balance_group']['lucky_baby_currency_balance_mapping'] = [
    //   '#type' => 'textarea',
    //   '#title' => $this->t('Currency Balance Mapping'),
    //   '#description' => $this->t("Define a mapping of product to currency. A product that
    //     appears on this configuration will be filtered according to the currencies
    //     defined.
    //     <br><br>
    //     Example
    //     <br>
    //     7|RMB,USD,KRW

    //   "),
    //   '#default_value' => $this->get('lucky_baby_currency_balance_mapping'),
    // ];

    // $form['balance_group']['lucky_baby_excluded_balance_mapping'] = [
    //   '#type' => 'textarea',
    //   '#title' => $this->t('Excluded Balance Mapping'),
    //   '#description' => $this->t('Define product IDs one per line'),
    //   '#default_value' => $this->get('lucky_baby_excluded_balance_mapping'),
    // ];
  }

  /**
  * {@inheritdoc}
  */
  // public function submit(array &$form, FormStateInterface $form_state) {
  //   $keys = [
  //     'logo_tooltip',
  //     'notification_strip',
  //     'notification_strip_content',
  //     'notification_platform',
  //     'notification_strip_scheduler',
  //     'notif_strip_start_date',
  //     'notif_strip_end_date',
  //     'user_id_label',
  //     'balance_label',
  //     'balance_error_message',
  //   ];

  //   foreach ($keys as $key) {
  //       switch ($key) {
  //           case 'notif_strip_start_date':
  //           case 'notif_strip_end_date':
  //               $data[$key] = strtotime($form_state->getvalue($key));
  //               break;
  //           default:
  //               $data[$key] = $form_state->getValue($key);
  //               break;
  //       }
  //   }

  //   $this->save($data);
  // }
}
