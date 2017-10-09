<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class ExportForm extends FormBase {

  /**
   * DomainExport object.
   *
   * @var $domainExport
   */
  private $domainExport;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->domainExport = \Drupal::service('webcomposer_domain_import.domain_export');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'export_taxonomy_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['webcomposer_domain_export'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Export Domains'),
      '#description' => $this->t('Allows you to export all domain data to an editable spreadsheet file.'),
    ];
    $form['webcomposer_domain_export']['label'] = [
      '#markup' => '<p></p>',
    ];
    $form['webcomposer_domain_export']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export'),
      '#submit' => [[$this->domainExport, 'domainExportExcel']],
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
