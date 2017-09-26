<?php

namespace Drupal\webcomposer_domain_import\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
Use Drupal\webcomposer_domain_import\Controller\WebcomposerDomainExport;

/**
 * Contribute form.
 */
class ExportForm extends FormBase {

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
    $export = new WebcomposerDomainExport();
    $form['webcomposer_domain_export'] = [
      '#type' => 'fieldset',
      '#title' => t('Export Domains'),
      '#description' => t('Allows you to export all domain data to an editable spreadsheet file.'),
    ];
    $form['webcomposer_domain_export']['label'] = [
      '#markup' => '<p></p>',
    ];
    $form['webcomposer_domain_export']['submit'] = [
      '#type' => 'submit',
      '#value' => t('Export'),
      '#submit' => [[$export, 'domain_export_excel']],
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
