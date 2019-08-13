<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class ImportForm extends FormBase {

  /**
   * DomainImport object.
   *
   * @var domainImport
   */
  protected $domainImport;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->domainImport = \Drupal::service('webcomposer_domain_import.domain_import');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'import_taxonomy_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['import_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Import file'),
      '#required' => TRUE,
      '#upload_validators'  => [
        'file_validate_extensions' => ['csv xml xlsx'],
        'file_validate_size' => [25600000],
      ],
      '#upload_location' => 'public://taxonomy_files/',
      '#description' => t('Upload a file to Import Domains! Supported format xlsx'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Import'),
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

    $optimizeInsert = $config->get('optimize_import');

    if(!empty($optimizeInsert)) {
      // placeholders batch
      $operations = [
        [[$this->domainImport, 'importPlaceholder'], [$form_state]],
      ];
      $batch = [
        'title' => t('Importing Domains'),
        'operations' => $operations,
        'init_message' => t('Batch is starting'),
      ];
      batch_set($batch);
      // get how many domains per batch
      $domainBatch = $config->get('domains_batch');
      $domainBatch = (int)$domainBatch + 1;

      $domains = $this->domainImport->getExcelDomains($form_state);
      foreach($domains as $group => $domain) {
        $operations = [
          [[$this->domainImport, 'importDomainGroup'],[$form_state, $group]]
        ];

        $domainsAvg = ceil(count($domain)/$domainBatch);
        for($i = 0; $i < $domainsAvg; $i++) {
          $domainSlice = array_slice($domain,($i * $domainBatch) ,$domainBatch);
          $operations[] = [[$this->domainImport, 'importDomain'],[$form_state, $domainSlice]];
        }
        // domains batch
        $batch = [
          'title' => t('Importing Domains'),
          'operations' => $operations,
          'init_message' => t('Importing domains - '. $group),
        ];
        batch_set($batch);
      }
      // delete batch
      $export_time = time();
      $operations = [
        [[$this->domainImport, 'deleteParagraphs'],[$form_state, $export_time]],
        [[$this->domainImport, 'deleteTaxonomies'],[$form_state, $export_time]],
      ];

      $batch = [
        'title' => t('Importing Domains'),
        'operations' => $operations,
        'init_message' => t('Batch is ending'),
      ];
      batch_set($batch);
    }
    else {
      $languages = $this->domainImport->getExcelLanguages($form_state);
      $operations = [
          [[$this->domainImport, 'importPrepare'], [$form_state]],
          [[$this->domainImport, 'importMasterPlaceholder'], [$form_state]],
      ];

      foreach ($languages as $key => $langcode) {
        $operations[] = [[$this->domainImport, 'importDomainGroups'],
        [$form_state, $langcode],
        ];
      }
      foreach ($languages as $key => $langcode) {
        $operations[] = [[$this->domainImport, 'importDomains'],
        [$form_state, $langcode],
        ];
      }
      $batch = [
        'title' => t('Importing Domains'),
        'operations' => $operations,
        'init_message' => t('Batch is starting.'),
      ];
      batch_set($batch);
    }
  }

}
