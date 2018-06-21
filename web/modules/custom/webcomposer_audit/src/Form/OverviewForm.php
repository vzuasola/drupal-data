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
        if (!empty($value) && $value !== 'any') {
          $filter[$key] = $value;
        }
      }
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
    $keys = [
      'title',
      'type',
      'action',
      'uid',
    ];

    foreach ($keys as $key) {
      $_SESSION['webcomposer_audit_filter'][$key] = $form_state->getValue($key);
    }
  }

  /**
   *
   */
  public function reset(array &$form, FormStateInterface $form_state) {
    $_SESSION['webcomposer_audit_filter'] = [];
  }
}
