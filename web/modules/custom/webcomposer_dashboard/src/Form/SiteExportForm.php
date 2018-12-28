<?php

namespace Drupal\webcomposer_dashboard\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Site\Settings;
use Drupal\Core\Url;

use DrupalProject\custom\FilesExport;

/**
 *
 */
class SiteExportForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'site_export_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!empty($_SESSION['webcomposer_dashboard.database_export_download.path'])) {
      $path = Url::fromRoute('webcomposer_dashboard.export_database_download');
      $filepath = $path->toString();

      $download = Markup::create("
        Database export link has been generated, please click
        <a class='excel-download-link' href='$filepath' target='_blank'>here</a>
      ");

      $form['download'] = [
        '#theme' => 'status_messages',
        '#message_list' => [
          'status' => [$download],
        ],
      ];
    }

    $form['database'] = [
      '#type' => 'details',
      '#title' => $this->t('Database Export'),
      '#open' => true,
      '#attributes' => [
        'style' => 'float: left; width: 100%;',
      ],
    ];

    $form['database']['label'] = [
      '#type' => 'markup',
      '#markup' => Markup::create("
        <p style='margin-top: 0'>
          This will allow you to export the Database using batch operation
        </p>
      "),
    ];

    $form['database']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export Database'),
      '#submit' => ['::exportDatabase'],
    ];

    $form['files'] = [
      '#type' => 'details',
      '#title' => $this->t('Files Export'),
      '#open' => true,
      '#attributes' => [
        'style' => 'float: left; width: 100%;',
      ],
    ];

    $form['files']['label'] = [
      '#type' => 'markup',
      '#markup' => Markup::create("
        <p style='margin-top: 0'>
          This will allow you to export the uploaded files for this site instance
        </p>
      "),
    ];

    $form['files']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Export Files'),
      '#submit' => ['::exportFiles'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function exportDatabase(array &$form, FormStateInterface $form_state) {
    \Drupal::service('webcomposer_dashboard.database_batch_operation')->doBatch();
  }

  /**
   * {@inheritdoc}
   */
  public function exportFiles(array &$form, FormStateInterface $form_state) {
    $path = \Drupal::service('file_system')->realpath(file_default_scheme() . "://");

    $date = date('m-d-Y--H-i-s');
    $product = Settings::get('product');

    $filename = "site-zip-export-$product-$date.zip";

    $fileExporter = new FilesExport();
    $fileExporter->export($path, $filename);
  }
}
