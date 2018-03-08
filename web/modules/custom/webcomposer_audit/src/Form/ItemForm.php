<?php

namespace Drupal\webcomposer_audit\Form;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Drupal\Component\Diff\Diff;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

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
    $title = ucwords($item['title']);

    if (isset($item['eid']) && isset($item['type'])) {
      $entity = \Drupal::entityManager()->getStorage($item['type'])->load($item['eid']);
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

    $rows['location'] = [
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
        $before = $entity->original;

        $textBefore = $this->getLineChangesFromEntity($before);
        $textAfter = $this->getLineChangesFromEntity($entity);
        break;

      case AuditStorageInterface::ADD:
        $textBefore = [];
        $textAfter = $this->getLineChangesFromEntity($entity);
        break;

      case AuditStorageInterface::DELETE:
        $textBefore = $this->getLineChangesFromEntity($entity);
        $textAfter = [];
        break;
      
      default:
        // we do not know what type of action this is so we skip diff generation
        return;
    }

    $diff = new Diff($textBefore, $textAfter);

    $formatter = \Drupal::service('diff.formatter');
    $formatter->show_header = FALSE;

    $form['diff_wrapper'] = [
      '#type' => 'container',
      '#attributes' => [
        'style' => 'margin-top: 50px;',
      ],
    ];

    $form['diff_wrapper']['diff'] = [
      '#type' => 'table',
      '#prefix' => '
        <h4 style="margin-top: 50px;">Comparison</h4>
        <p>Differences during this audit event</p>
      ',
      '#attributes' => [
        'class' => ['diff'],
      ],
      '#header' => [
        ['data' => t('Before'), 'colspan' => '2'],
        ['data' => t('After'), 'colspan' => '2'],
      ],
      '#rows' => $formatter->format($diff),
    ];

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
  private function getLineChangesFromEntity($entity) {
    $map = var_export($entity->toArray(), TRUE);
    $lines = explode(PHP_EOL, $map);

    return $lines;

    // return array_filter($lines, function ($item) {
    //   return !empty(trim($item));
    // });
  }
}
