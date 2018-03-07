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
      '#title' => $this->t('Filter log messages'),
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
    ];

    $form['filters']['wrapper']['entity'] = [
      '#title' => 'Entity',
      '#type' => 'select',
      '#options' => ['any' => '-- Any --'] + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('entity', [
        'callback' => function (&$item) {
          $item = ucwords(str_replace('_', ' ', $item));
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
    ];

    $form['filters']['wrapper']['action'] = [
      '#title' => 'Action',
      '#type' => 'select',
      '#options' => ['any' => '-- Any --'] + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('action', [
        'callback' => function (&$item) {
          $item = ucwords(str_replace('_', ' ', $item));
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
    ];

    $form['filters']['wrapper']['user'] = [
      '#title' => 'User',
      '#type' => 'select',
      '#options' => ['any' => '-- Any --'] + \Drupal::service('webcomposer_audit.database_storage')->getDistinct('uid', [
        'callback' => function (&$item) {
          $item = \Drupal::entityManager()->getStorage('user')->load($item)->getUsername();
        }
      ]),
      '#attributes' => [
        'style' => 'padding-top: 5px; padding-bottom: 5px;',
      ],
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
        'data' => $this->t('Entity'),
        'field' => 'w.entity',
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
    ]);

    foreach ($entries as $key => $value) {
      $title = ucwords($value->title);

      if ($value->eid && $value->entity) {
        $entity = \Drupal::entityManager()->getStorage($value->entity)->load($value->eid);

        if ($entity) {
          $title = $this->l($title, $entity->toUrl());
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
        'entity' => ucwords(str_replace('_', ' ', $value->entity)),
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
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   *
   */
  public function reset(array &$form, FormStateInterface $form_state) {
  }
}
