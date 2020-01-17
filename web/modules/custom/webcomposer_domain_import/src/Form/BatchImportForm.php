<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class BatchImportForm extends FormBase {

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
    if (empty(self::$instanceId)) {
      self::$instanceId = 1;
    }
    else {
      self::$instanceId++;
    }
  
    return 'batch_import_form' . self::$instanceId;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $extras = []) {
    $form['domains'] = array(
      '#type' => 'container',
      '#title' => $extras['group'] . " Batch ",
    );

    $form['domains']["text"] = array(
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $extras["action"],
    );
    
    $form['actions']['domains'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Import'),
      '#name' => $extras['id']. "_submit",
      '#submit' => $extras['submit_callback'],
    );
   
    if (isset($extras["domain_slice"])) {
      $form['domains_list'] = array(
        '#type' => 'hidden',
        '#value' => implode(", ", $extras["domain_slice"]),
      );
    }

    if (isset($extras["group"])) {
      $form['group'] = array(
        '#type' => 'hidden',
        '#value' => $extras["group"],
      );
    }

    $form['#attributes']['id'] = $extras['id'];
    $form['fid'] = array(
      '#type' => 'hidden',
      '#value' => $extras['fid'],
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function submitPlaceholder(array &$form, FormStateInterface $form_state) {
    $operations = [
        [[$this->domainImport, 'importPlaceholder'], [$form_state]],
    ];
    $batch = [
    'title' => t('Importing Domains'),
    'operations' => $operations,
    'init_message' => t('Importing placeholders'),
    ];
    batch_set($batch);
  }

  public function submitDomainGroup(array &$form, FormStateInterface $form_state) {
    $operations = [
      [[$this->domainImport, 'importDomainGroup'], [$form_state, $form_state->getValue('group')]]
    ];
    // domains batch
    $batch = [
      'title' => t('Importing Domains'),
      'operations' => $operations,
      'init_message' => t('Importing domain group - '. $form_state->getValue('group')),
    ];
    batch_set($batch);
  }

  public function submitDomainBatch(array &$form, FormStateInterface $form_state) {
    $domain_slice = explode(", ", $form_state->getValue('domains_list'));
    $operations[] = [[$this->domainImport, 'importDomain'], [$form_state, $domain_slice, $form_state->getValue('group')]];
    $operations2[] = [[$this->domainImport, 'importDomainTranslated'], [$form_state, $domain_slice]];
    foreach ($domain_slice as $domain) {
      $operations3[] = [[$this->domainImport, 'importDomainPlaceholderTrans'], [$form_state, $domain]];
    }
    
    // domains batch in default language
    $batch = [
      'title' => t('Importing Domains'),
      'operations' => $operations,
      'init_message' => t('Importing domains '),
    ];
    batch_set($batch);
  
    // translate domains batch
    $batch = [
      'title' => t('Translating Domains'),
      'operations' => $operations2,
      'init_message' => t('Translating domains'),
    ];
    batch_set($batch);

    // translate domains placeholoder overrides
    $batch = [
      'title' => t('Translating Paragraphs'),
      'operations' => $operations3,
      'init_message' => t('Translating domain placeholders'),
    ];
    batch_set($batch);
  }

  public function submitDomainRemoveBackup(array &$form, FormStateInterface $form_state) {
    // delete batch
    $export_time = time();
    $operations = [
      [[$this->domainImport, 'deleteParagraphs'], [$form_state, $export_time]],
      [[$this->domainImport, 'deleteTaxonomies'], [$form_state, $export_time]],
    ];

    $batch = [
      'title' => t('Importing Domains'),
      'operations' => $operations,
      'init_message' => t('Batch is ending'),
    ];
    batch_set($batch);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // placeholder
  }

}
