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
   * @var domainExport
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
      // '#submit' => [[$this->domainExport, 'domainExportExcel']],
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

    $config = $this->config('webcomposer_config.toggle_configuration');
    $batchExport = $config->get('use_batch_export');
    if ($batchExport) {
      $operations = [
        [[$this->domainExport, 'exportLanguages'], [$form_state]],
        [[$this->domainExport, 'exportDomains'], [$form_state]],
        [[$this->domainExport, 'exportPlaceholders'], [$form_state]],
      ];

       // Get all languages from which are enabled.
      $languages = $this->domainExport->getAvailableLanguage();
      foreach ($languages as $key => $value) {
        array_push($operations,  [[$this->domainExport, 'exportVariablesPerLang'], [$form_state, $key]]);
      }

      $batch = [
        'title' => t('Exporting Domains'),
        'operations' => $operations,
        'init_message' => t('Batch is starting.'),
        'progress_message' => t('Processed @current out of @total.'),
        'finished' => [$this->domainExport, 'domainExportFinishedCallback'],
      ];
      batch_set($batch);
    } else {
      $this->domainExport->domainExportExcel();
    }
  }

}
