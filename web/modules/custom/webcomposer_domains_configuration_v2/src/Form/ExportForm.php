<?php

namespace Drupal\webcomposer_domains_configuration_v2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\webcomposer_domains_configuration_v2\Service\DomainExportService;

class ExportForm extends FormBase {
  /**
   *
   */
  const FORM_ID = 'export_domains_form';
  /**
   * @var
   */
  protected static $instanceId;
  /**
   * @var DomainExportService
   */
  private $domainExport;


  /**
   * Constructor.
   */
  public function __construct() {
    $this->domainExport = \Drupal::service('webcomposer_domains_configuration_v2.domain_export');
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
      '#submit' => [[$this->domainExport, 'execute']],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
