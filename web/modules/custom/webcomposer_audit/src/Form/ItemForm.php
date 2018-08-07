<?php

namespace Drupal\webcomposer_audit\Form;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Drupal\Component\Diff\Diff;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\TypedData\TypedDataInterface;

use Drupal\webcomposer_audit\Storage\AuditStorageInterface;

/**
 *
 */
class ItemForm extends FormBase {
  /**
   *
   */
  public function __construct() {
    $this->route = $this->getRouteMatch();
    $this->database = \Drupal::service('database');
    $this->storage = \Drupal::service('webcomposer_audit.database_storage');
    $this->user = \Drupal::entityManager()->getStorage('user');

    $id = $this->route->getParameter('id');
    $this->item = $this->storage->get($id);
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_audit_item_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (empty($this->item)) {
      throw new NotFoundHttpException();
    }

    $this->buildInfoForm($form, $form_state);
    $this->buildComparisonForm($form, $form_state);

    return $form;
  }

  /**
   *
   */
  private function buildInfoForm(array &$form, FormStateInterface $form_state) {
    $rows = [];

    $item = $this->item;
    $title = trim(trim($item['title']), '>');

    if (isset($item['type']) && $item['type'] == 'config') {
      $title = $item['title'];

      $title = [
        'data' => [
          '#markup' => "<strong>$title</strong>"
        ]
      ];
    }

    if (isset($item['eid']) && isset($item['type'])) {
      try {
        $entity = \Drupal::entityManager()->getStorage($item['type'])->load($item['eid']);
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

    $rows['title'] = [
      ['data' => ['#markup' => '<strong>Title</strong>']],
      $title,
    ];

    $rows['entity'] = [
      ['data' => ['#markup' => '<strong>Entity</strong>']],
      ucwords(str_replace('_', ' ', $item['type'])),
    ];

    $rows['action'] = [
      ['data' => ['#markup' => '<strong>Action</strong>']],
      ucwords(str_replace('_', ' ', $item['action'])),
    ];

    $rows['user'] = [
      ['data' => ['#markup' => '<strong>User</strong>']],
      [
        'data' => [
          '#theme' => 'username',
          '#account' => $this->user->load($item['uid']),
        ],
      ],
    ];

    $rows['date'] = [
      ['data' => ['#markup' => '<strong>Date</strong>']],
      \Drupal::service('date.formatter')->format($item['timestamp'], 'short'),
    ];

    $rows['location'] = [
      ['data' => ['#markup' => '<strong>Location</strong>']],
      $item['location'],
    ];

    $rows['language'] = [
      ['data' => ['#markup' => '<strong>Language</strong>']],
      strtoupper($item['language']),
    ];

    $form['table'] = [
      '#type' => 'table',
      '#prefix' => '
        <h4 style="margin-top: 50px;">Details</h4>
        <p>Event description and details</p>
      ',
      '#rows' => $rows,
    ];
  }

  /**
   *
   */
  private function buildComparisonForm(array &$form, FormStateInterface $form_state) {
    $item = $this->item;

    $entity = unserialize($this->item['entity']);

    switch ($item['action']) {
      case AuditStorageInterface::UPDATE:
        // for non standard entities
        if (method_exists($entity, 'getOriginal')) {
          $original = $entity->getOriginal();
        } else {
          $original = $entity->original;
        }

        $compare = $this->generateCompareDiff($original, $entity);
        break;

      case AuditStorageInterface::ADD:
        $compare = $this->generateCompareDiff([], $entity);
        break;

      case AuditStorageInterface::DELETE:
        $compare = $this->generateCompareDiff($entity, []);
        break;

      default:
        // we do not know what type of action this is so we skip diff generation
        return;
    }

    $formatter = \Drupal::service('diff.formatter');
    $formatter->show_header = FALSE;

    foreach ($compare as $key => $value) {
      $diff = new Diff($value['left'], $value['right']);

      if (!$diff->isEmpty()) {
        $rows[$key] = [
          '#type' => 'table',
          '#attributes' => [
            'class' => ['diff'],
          ],
          '#header' => [
            ['data' => ucwords($key), 'colspan' => '4', 'style' => 'padding: 5px 12px;'],
          ],
          '#rows' => $formatter->format($diff),
        ];
      }
    }

    $form['diff_wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'style' => 'margin-top: 50px;',
      ],
    ];

    if (!empty($rows)) {
      $form['diff_wrapper']['diff'] = [
        '#type' => 'table',
        '#prefix' => '
          <h4 style="margin-top: 50px;">Comparison</h4>
          <p>Differences during this audit event</p>
        ',
        '#attributes' => [
          'class' => ['diff'],
          'style' => 'margin-bottom: 0;'
        ],
        '#header' => [
          ['data' => t('Before'), 'colspan' => '2', 'style' => 'border: solid transparent'],
          ['data' => t('After'), 'colspan' => '2', 'style' => 'border: solid transparent'],
        ],
      ];

      $form['diff_wrapper'] += $rows;
    } else {
      // if the form is empty then show this message

      $form['diff_wrapper']['text'] = [
        '#prefix' => '
          <h4 style="margin-top: 50px;">Comparison</h4>
          <p>Differences during this audit event</p>
        ',
        '#theme' => 'status_messages',
        '#message_list' => [
          'warning' => ['There has been no changes for this event.'],
        ],
      ];
    }

    $form['#attached']['library'][] = 'system/diff';
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
  private function generateCompareDiff($before, $after) {
    $map = [];

    $before = $this->getLineChangesFromEntity($before);
    $after = $this->getLineChangesFromEntity($after);

    $before_keys = array_keys($before);
    $after_keys = array_keys($after);

    $keys = array_replace($before_keys, $after_keys);

    foreach ($keys as $key) {
      $map[$key]['left'] = [""];
      $map[$key]['right'] = [""];

      if (!empty($before[$key])) {
        $map[$key]['left'] = [
          $before[$key]
        ];
      }

      if (!empty($after[$key])) {
        $map[$key]['right'] = [
          $after[$key]
        ];
      }
    }

    return $map;
  }

  /**
   *
   */
  private function getLineChangesFromEntity($entity) {
    $map = [];
    $entityType = "";

    if (!empty($entity) && $entity->getEntityTypeId()) {
      $entityType = $entity->getEntityTypeId();
    }

    foreach ($entity as $key => $value) {
      if ($value instanceof TypedDataInterface) {
        $map[$value->getName()] = $value->getString();

        // checking if the format text area is under custom config
        if (is_array($value->getValue()) && $entityType === "config") {
          // mapping for format text area of custom config
          $map[$value->getName()] = $value->getValue()['value'];
        }
      } elseif ($value instanceof EntityInterface) {
        $map[$key] = $this->getLineChangesFromEntity($value->toArray());
      } else {
        $map[$key] = $value;
      }
    }

    return $map;
  }
}
