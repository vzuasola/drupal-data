<?php

namespace Drupal\webcomposer_audit\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

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
        'class' => [RESPONSIVE_PRIORITY_MEDIUM]
      ],
    ];

    $storage = \Drupal::service('webcomposer_audit.database_storage');

    $rows = [];

    $entries = $storage->all([
      'header' => $header,
    ]);

    foreach ($entries as $key => $value) {
      $rows[$key] = [
        'title' => $value->title,
        'entity' => $value->entity,
        'action' => $value->action,
        'user' => $value->uid,
        'date' => $value->timestamp,
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
