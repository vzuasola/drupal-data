<?php

namespace Drupal\webcomposer_audit\Form;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $title = $this->l($title, $entity->toUrl('edit-form'));
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

    $form['table'] = [
      '#type' => 'table',
      '#rows' => $rows,
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
