<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_domain_import\Controller\WebcomposerDomainImport;

/**
 * Contribute form.
 */
class ImportForm extends FormBase {

  /**
   * DomainImport object.
   *
   * @var domainImport
   */
  private $domainImport;

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
      '#description' => t('Upload a file to Import taxonomy! Supported format xlsx'),
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
    kint($this->domainImport);die();
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
