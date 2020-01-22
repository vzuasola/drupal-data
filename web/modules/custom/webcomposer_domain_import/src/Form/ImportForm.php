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
  protected static $instanceId;

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

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Next'),
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
    $_SESSION['webcomposer_domain_import']['processed_forms'] = [];
    $config = $this->config('webcomposer_config.toggle_configuration');
    $optimizeImport = $config->get('optimize_import');

    if(!empty($optimizeImport)) {
      $domain_import = \Drupal::service('webcomposer_domain_import.domain_import');
      $validate = $domain_import->validateExcelFile($form_state);
      if (!$validate['status']) {
        drupal_set_message($validate['message'], 'error');
      } else {
        $form_state->setRedirect('webcomposer_domain_import.webcomposer_domain_batch_import', [
          'import_file' => $form_state->getValue('import_file')
        ]);
      }
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
