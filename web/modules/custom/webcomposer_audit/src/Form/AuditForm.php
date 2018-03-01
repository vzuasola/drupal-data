<?php

namespace Drupal\webcomposer_audit\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class AuditForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'audit_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $header = [
      'Action',
      'Type',
      'Name',
      'Manage'
    ];

    $storage = \Drupal::service('webcomposer_audit.database_storage');

    $rows = [];
    $entries = $storage->all();

    foreach ($entries as $key => $value) {
      $rows[$key] = [
        'action' => $value['action'],
        'type' => $value['type'],
        'name' => $value['name'],
        'manage' => 'Manage',
      ]; 
    }

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No users found'),
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
