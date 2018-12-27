<?php

namespace Drupal\webcomposer_dashboard\Batch;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Drupal\Core\Site\Settings;

use DrupalProject\custom\DatabaseExport;

/**
 *
 */
class DatabaseBatchOperation {
  use DependencySerializationTrait;

  private $database;
  private $databaseExporter;
  private $product;

  /**
   *
   */
  public function __construct() {
    $this->database = \Drupal::service('database');
    $this->databaseExporter = new DatabaseExport();
    $this->product = Settings::get('product');
  }

  /**
   *
   */
  public function doBatch() {
    $connection = $this->database->getConnectionOptions();

    $tables = $this->databaseExporter->getTables(
      $connection['host'],
      $connection['username'],
      $connection['password'],
      $connection['database'],
      ['batch*', 'cache*', 'flood', 'webcomposer_audit', 'webform_submission']
    );

    // initialize the download file

    $file = $this->doCreateDownload(NULL);

    // write the prefix

    $prefix = $this->databaseExporter->preExport($connection['database']);
    file_put_contents($file->getFileUri(), $prefix, FILE_APPEND);

    foreach ($tables as $table) {
      $operations[] = [
        [$this, 'doProcessTable'],
        [$table, $connection, $file],
      ];
    }

    $batch = [
      'title' => t('Exporting Database'),
      'operations' => $operations,
      'finished' => [$this, 'doProcessFinish'],
    ];

    batch_set($batch);
  }

  /**
   *
   */
  public function doProcessTable($table, $connection, $file, &$context) {
    if (!isset($context['result']['file'])) {
      $context['results']['file'] = $file;
    }

    $dump = $this->databaseExporter->processTable(
      $table,
      $connection['host'],
      $connection['username'],
      $connection['password'],
      $connection['database']
    );

    file_put_contents($file->getFileUri(), $dump, FILE_APPEND);
  }

  /**
   *
   */
  public function doProcessFinish($success, $results, $operations) {
    $file = $results['file'];
    $connection = $this->database->getConnectionOptions();

    // write the suffix

    $suffix = $this->databaseExporter->postExport();
    file_put_contents($file->getFileUri(), $suffix, FILE_APPEND);

    // tell the session that there is a file that needs to be downloaded

    $path = Url::fromUri($file->url());
    $_SESSION['webcomposer_dashboard_database_export_download'] = $path->getUri();
  }

  /**
   *
   */
  private function doCreateDownload($dump) {
    $date = date('m-d-Y--H-i-s');

    if ($this->product) {
      $date = $this->product . '--' . $date;
    }

    $filepath = "public://database-export-$date.sql";

    $file = file_save_data($dump, "public://database-export-$date.sql");
    $file->setTemporary();
    $file->save();

    return $file;
  }
}

