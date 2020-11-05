<?php

namespace Drupal\webcomposer_domains_configuration_v2\Form;

use Drupal;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_config_schema\Annotation\WebcomposerConfigPlugin;
use Drupal\webcomposer_domains_configuration_v2\Service\DomainImportService;
use Throwable;

class ImportForm extends FormBase {
  const FORM_ID = 'import_domains_form';
  protected static $instanceId;
  protected $enabled;

  /** @var DomainImportService $domainImportService */
  protected $domainImportService;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->enabled = true;
    $this->domainImportService = Drupal::service('webcomposer_domains_configuration_v2.domain_import');
  }

  /**
   * {@inheritdoc}
   *
   * @return string
   */
  public function getFormId() {
    return self::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['import_file'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Import file'),
      '#required' => TRUE,
      '#upload_validators' => [
        'file_validate_extensions' => ['xlsx'],
        'file_validate_size' => [25600000],
      ],
      '#upload_location' => 'public://taxonomy_files/',
      '#description' => t('Upload a file to Import Domains! Supported format xlsx'),
      '#disabled' => !$this->enabled
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#disabled' => !$this->enabled
    ];
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // If this module is not enabled do nothing
    if (!$this->enabled) {
      drupal_set_message('Failed to import domains due to the following reason(s): Module not enabled!', 'error');
    }

    try {
      $this->domainImportService->execute($form_state);
      drupal_set_message('The domains was imported successfully.');
    } catch (Throwable $e) {
      drupal_set_message('Failed to import domains due to the following reason(s): ' . $e->getMessage(), 'error');
    }
  }

}
