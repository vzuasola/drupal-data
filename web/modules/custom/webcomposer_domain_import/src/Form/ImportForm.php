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
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'import_taxonomy_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $import = new WebcomposerDomainImport();
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
    $form['actions']['#type'] = 'actions';
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
    $import = new WebcomposerDomainImport();
    $languages = $import->getExcelLanguages($form_state);
    $operations = [
        [[$import, 'importPrepare'], [$form_state]],
        [[$import, 'importDomainGroups'], [$form_state]],
        [[$import, 'importMasterPlaceholder'], [$form_state]],

    ];
    foreach ($languages as $key => $langcode) {
      $operations[] = [[$import, 'importDomains'], [$form_state, $langcode]];
    }

    $batch = [
      'title' => t('Importing Domains'),
      'operations' => $operations,
      'init_message' => t('Batch is starting.'),
      'finished' => '\Drupal\webcomposer_domain_import\Controller\WebcomposerDomainImport::domainImportFinishedCallback',
    ];
    batch_set($batch);
  }

}
