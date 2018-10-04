<?php

namespace Drupal\webcomposer_audit\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 *
 */
class OverviewForm extends FormBase {
  /**
   * @inheritdoc
   */
   /**
   * ICore Games Integration Configuration Form
   */
  const DATE_FORMAT = 'm/d/Y';
  const TIME_FORMAT = 'h:i:s A';
  const DEFAULT_LIMIT = 50;
  const TIME_FRAMES = [
    'last_week' => 'P1W',
    'last_month' => 'P1M',
  ];
  const FILTER_KEYS = [
    'title',
    'type',
    'action',
    'uid',
  ];
  const FILTER_DATE_KEYS = [
    'date_start',
    'date_end',
  ];
  const FILTER_KEYS_OTHERS = [
    'limit',
    'date_picker'
  ];
  const DATE_PICKER = [
    '0' => '-none-',
    '-1 day' => '1 DAY',
    '-3 day' => '3 DAY',
    '-1 week' => '1 WEEK',
    '-2 week' => '2 WEEK',
    '-1 month' => '1 MONTH',
    '-2 month' => '2 MONTH',
  ];
  const LOGS_PER_PAGE = [
    '10' => 10,
    '20' => 20,
    '50' => 50,
    '100' => 100,
  ];


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_audit_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!empty($_SESSION['webcomposer_audit_filter'])) {
      $message = "Filters are applied for this view. You may see fewer results. Reset the filter to view all entries.";

      $form['message'] = [
        '#theme' => 'status_messages',
        '#message_list' => [
          'warning' => [$message],
        ],
      ];
    }


    $this->buildFilterForm($form, $form_state);
    $this->buildTableForm($form, $form_state);

    return $form;
  }

  /**
   *
   */
  private function buildFilterForm(array &$form, FormStateInterface $form_state) {
    $form['filters'] = [
      '#type' => 'details',
      '#title' => $this->t('Filter Audit Logs'),
      '#open' => TRUE,
    ];

    $form['filters']['wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => 'form--inline',
      ],
    ];

    $form['filters']['wrapper']['title'] = [
      '#title' => 'Title',
      '#type' => 'textfield',
      '#size' => 30,
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['title']) ? $_SESSION['webcomposer_audit_filter']['title'] : '',
    ];

    $options = ['any' => '- Any -'];

    $form['filters']['wrapper']['type'] = [
      '#title' => 'Type',
      '#type' => 'select',
      '#options' => $options + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('type', [
        'callback' => function (&$item) {
          $item = ucwords(str_replace('_', ' ', $item));
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['type']) ? $_SESSION['webcomposer_audit_filter']['type'] : 'any',
    ];

    $form['filters']['wrapper']['action'] = [
      '#title' => 'Action',
      '#type' => 'select',
      '#options' => $options + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('action', [
        'callback' => function (&$item) {
          $item = ucwords(str_replace('_', ' ', $item));
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['action']) ? $_SESSION['webcomposer_audit_filter']['action'] : 'any',
    ];

    $form['filters']['wrapper']['uid'] = [
      '#title' => 'User',
      '#type' => 'select',
      '#options' => $options + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('uid', [
        'callback' => function (&$item) {
          $user = \Drupal::entityManager()->getStorage('user')->load($item);

          if ($user) {
            $item = $user->getUsername();
          }
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['user']) ? $_SESSION['webcomposer_audit_filter']['user'] : 'any',
    ];

    $form['filters']['wrapper']['limit'] = [
      '#title' => 'Logs Per Page',
      '#type' => 'select',
      '#options' => self::LOGS_PER_PAGE,
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['limit']) ?
        $_SESSION['webcomposer_audit_filter']['limit'] : self::DEFAULT_LIMIT,
    ];

    $form['filters']['wrapper']['date'] = [
      '#type' => 'fieldset',
      '#title' => t('Date Filters'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#attributes' => [
        'style' =>'clear: both; display: inline-block; float: left;',
      ],
    ];

    $form['filters']['wrapper']['date']['date_start'] = [
      '#title' => 'Start Date',
      '#type' => 'datetime',
      '#size' => 20,
      '#default_value' => $this->getDateValue('date_start'),
      '#date_date_format' => self::DATE_FORMAT,
      '#date_time_format' => self::TIME_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_end'] = [
      '#title' => 'End Date',
      '#type' => 'datetime',
      '#size' => 20,
      '#default_value' => $this->getDateValue('date_end'),
      '#date_date_format' => self::DATE_FORMAT,
      '#date_time_format' => self::TIME_FORMAT,
      '#prefix' => '<div class="js-form-item form-item js-form-type-select form-type-select js-form-item-uid form-item-uid">',
      '#suffix' => '</div>',
    ];

    $form['filters']['wrapper']['date']['date_picker'] = [
      '#title' => 'Date Picker',
      '#description' => 'If a value is selected, Start and End Date Filters will be ignored.',
      '#type' => 'select',
      '#options' => self::DATE_PICKER,
      '#attributes' => [
        'style' => 'margin-top: 10px; padding-top: 5px; padding-bottom: 5px;',
      ],
      '#default_value' => isset($_SESSION['webcomposer_audit_filter']['date_picker']) ?
        $_SESSION['webcomposer_audit_filter']['date_picker'] : '-none-',
    ];

    $form['filters']['wrapper']['actions'] = [
      '#type' => 'actions',
    ];

    $form['filters']['wrapper']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Filter'),
    ];

    $form['filters']['wrapper']['actions']['reset'] = [
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => ['::reset'],
    ];
  }

  /**
   *
   */
  private function buildTableForm(array &$form, FormStateInterface $form_state) {
    $header = [
      [
        'data' => $this->t('Title'),
        'field' => 'w.title',
        'class' => [RESPONSIVE_PRIORITY_MEDIUM]
      ],
      [
        'data' => $this->t('Type'),
        'field' => 'w.type',
        'class' => [RESPONSIVE_PRIORITY_MEDIUM]
      ],
      [
        'data' => $this->t('Action'),
        'field' => 'w.action',
        'class' => [RESPONSIVE_PRIORITY_MEDIUM]
      ],
      [
        'data' => $this->t('User'),
        'field' => 'ufd.name',
        'class' => [RESPONSIVE_PRIORITY_MEDIUM]
      ],
      [
        'data' => $this->t('Date'),
        'field' => 'w.timestamp',
        'class' => [RESPONSIVE_PRIORITY_MEDIUM],
        'sort' => 'desc'
      ],
      [
        'data' => 'Language',
      ],
      [
        'data' => 'Operations',
      ]
    ];

    $rows = [];
    $storage = \Drupal::service('webcomposer_audit.database_storage');
    $entries = $storage->all([
      'header' => $header,
      'where' => $this->getOverviewFilter(),
      'limit' => $this->getPageLimit(),
    ]);

    foreach ($entries as $key => $value) {
      $title = trim(trim($value->title), '>');

      if (isset($value->type) && $value->type == 'config') {
        $title = $value->title;

        $title = [
          'data' => [
            '#markup' => "<strong>$title</strong>"
          ]
        ];
      }

      if ($value->eid && $value->type) {
        try {
          $entity = \Drupal::entityManager()->getStorage($value->type)->load($value->eid);
        } catch (\Exception $e) {
          $entity = NULL;
        }

        if ($entity) {
          try {
            $title = $this->l($title, $entity->toUrl('edit-form'));
          } catch (\Exception $e) {
            // do nothing
          }
        }
      }

      $username = [
        '#theme' => 'username',
        '#account' => \Drupal::entityManager()->getStorage('user')->load($value->uid),
      ];

      $url = new Url('webcomposer_audit.audit_item_view', [
        'id' => $value->id,
      ]);

      $operations = [
        'data' => [
          '#type' => 'operations',
          '#links' => [
            'edit' => [
              'url' => $url,
              'title' => 'View'
            ],
          ],
        ],
      ];

      $rows[$key] = [
        'title' => $title,
        'type' => ucwords(str_replace('_', ' ', $value->type)),
        'action' => ucwords(str_replace('_', ' ', $value->action)),
        'user' => ['data' => $username],
        'date' => \Drupal::service('date.formatter')->format($value->timestamp, 'short'),
        'language' => strtoupper($value->language),
        'operations' => $operations,
      ];
    }

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No available log entries found'),
    ];

    $form['pager'] = [
      '#type' => 'pager'
    ];
  }

  /**
   *
   */
  private function getOverviewFilter() {
    $filter = [];

    if (isset($_SESSION['webcomposer_audit_filter'])) {
      foreach ($_SESSION['webcomposer_audit_filter'] as $key => $value) {
        if (!empty($value) && $value !== 'any' && in_array($key, self::FILTER_KEYS)) {
          $filter[$key] = $value;
        }
      }
    }

    $dateFilter = $this->getDateFilter();
    if ($dateFilter) {
      $filter['timestamp'] = $dateFilter;
    }

    return $filter;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach (self::FILTER_KEYS as $key) {
      $_SESSION['webcomposer_audit_filter'][$key] = $form_state->getValue($key);
    }

    $format = self::DATE_FORMAT . ' ' . self::TIME_FORMAT;
    foreach (self::FILTER_DATE_KEYS as $key) {
      if (is_object($form_state->getValue($key))) {
        $_SESSION['webcomposer_audit_filter'][$key] = $form_state->getValue($key)->format($format);
      } else {
        // Delete the session
        unset($_SESSION['webcomposer_audit_filter'][$key]);
      }
    }

    foreach (self::FILTER_KEYS_OTHERS as $key) {
      $_SESSION['webcomposer_audit_filter'][$key] = $form_state->getValue($key);
    }
  }

  /**
   *
   */
  public function reset(array &$form, FormStateInterface $form_state) {
    $_SESSION['webcomposer_audit_filter'] = [];
  }

  /**
   * Retrieves the default values for Drupal's DateTime field
   */
  private function getDateValue($field) {
    if (isset($_SESSION['webcomposer_audit_filter'][$field])) {
      return new \Drupal\Core\Datetime\DrupalDateTime($_SESSION['webcomposer_audit_filter'][$field]);
    }

    return '';
  }

  /**
   * Processes timestamp query depending on date filters set
   */
  private function getDateFilter() {
    $date_picker = $_SESSION['webcomposer_audit_filter']['date_picker'];
    if ($date_picker && $date_picker !== 0) {
      return [
        'value' => strtotime($date_picker),
        'operator' => '>='
      ];
    } else {
      $date_start = (isset($_SESSION['webcomposer_audit_filter']['date_start'])) ?
        strtotime($_SESSION['webcomposer_audit_filter']['date_start']) : null;
      $date_end = (isset($_SESSION['webcomposer_audit_filter']['date_end'])) ?
        strtotime($_SESSION['webcomposer_audit_filter']['date_end']) : null;

      if ($date_start && $date_end) {
        return [
          'value' => [
            $date_start,
            $date_end
          ],
          'operator' => 'BETWEEN'
        ];
      } elseif ($date_start) {
        return [
          'value' => $date_start,
          'operator' => '>='
        ];
      } elseif ($date_end) {
        return [
          'value' => $date_end,
          'operator' => '<='
        ];
      }
    }

    return false;
  }

  /**
   * Gets the default or set Page Limit
   */
  private function getPageLimit() {
    if (isset($_SESSION['webcomposer_audit_filter']['limit'])) {
      return $_SESSION['webcomposer_audit_filter']['limit'];
    }

    return self::DEFAULT_LIMIT;
  }
}
