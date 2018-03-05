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
        'class' => [RESPONSIVE_PRIORITY_HIGH],
        'sort' => 'desc'
      ],
    ];

    $rows = [];
    $storage = \Drupal::service('webcomposer_audit.database_storage');

    $entries = $storage->all([
      'header' => $header,
    ]);

    foreach ($entries as $key => $value) {
      $title = ucwords($value->title);

      if ($value->link) {
        $title = $this->l($title, Url::fromUri('internal:' . $value->link));
      }

      $rows[$key] = [
        'title' => $title,
        'entity' => ucwords(str_replace('_', ' ', $value->entity)),
        'action' => ucwords(str_replace('_', ' ', $value->action)),
        'user' => $value->uid,
        'date' => \Drupal::service('date.formatter')->format($value->timestamp, 'short'),
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
