<?php

namespace Drupal\webcomposer_audit\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\ConfirmFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a confirmation form before clearing out the logs.
 */
class ResetForm extends ConfirmFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_audit_reset_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the all audit logs?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('webcomposer_audit.audit_form');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $username = \Drupal::currentUser()->getUsername();

    if ($username === 'master') {
      \Drupal::service('webcomposer_audit.database_storage')->truncate();

      drupal_set_message($this->t('Audit log cleared.'));
    } else {
      drupal_set_message($this->t('Permission denied for clearing the audit logs.'), 'error');
    }

    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
