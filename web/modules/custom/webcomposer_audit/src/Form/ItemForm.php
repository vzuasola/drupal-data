<?php

namespace Drupal\webcomposer_audit\Form;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Drupal\Component\Diff\Diff;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

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
    $id = $this->route->getParameter('id');
    $item = $this->storage->get($id);

    if (empty($item)) {
      throw new NotFoundHttpException();
    }

    $rows = [];

    $title = ucwords($item['title']);

    if (isset($item['eid']) && isset($item['entity'])) {
      $entity = \Drupal::entityManager()->getStorage($item['entity'])->load($item['eid']);
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
      ucwords(str_replace('_', ' ', $item['entity'])),
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

    $before = unserialize($item['data_before']);
    $after = unserialize($item['data_after']);

    $form['#attached']['library'][] = 'system/diff';

    $form['table'] = [
      '#type' => 'table',
      '#prefix' => '
        <h4 style="margin-top: 50px;">Details</h4>
        <p>Event description and details</p>
      ',
      '#rows' => $rows,
    ];

    $textBefore = var_export($before->toArray(), TRUE);
    $textAfter = var_export($after->toArray(), TRUE);

    $textBefore = explode(PHP_EOL, $textBefore);
    $textAfter = explode(PHP_EOL, $textAfter);

    $textBefore = array_filter($textBefore, function ($item) {
      return !empty(($item));
    });

    $textAfter = array_filter($textAfter, function ($item) {
      return !empty(($item));
    });

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

    return $form;
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
}
