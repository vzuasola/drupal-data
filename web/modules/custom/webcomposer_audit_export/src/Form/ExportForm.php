<?php

namespace Drupal\webcomposer_audit_export\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class ExportForm extends FormBase {

  /**
   * logsExport object.
   *
   * @var logsExport
   */
  private $logsExport;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->logsExport = \Drupal::service('webcomposer_audit_export.logs_export');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'export_logs_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['webcomposer_logs_export'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Export Audit Logs'),
      '#description' => $this->t('Allows you to export audit logs data to a spreadsheet file.'),
    ];
    $form['webcomposer_logs_export']['label'] = [
      '#markup' => '<p></p>',
    ];
    $form['webcomposer_logs_export']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export'),
      '#submit' => [[$this->logsExport, 'logsExportExcel']],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
