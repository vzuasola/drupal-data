<?php

namespace Drupal\webcomposer_dashboard\Batch;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Url;
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

  public function __construct() {
    $this->database = \Drupal::service('database');
    $this->databaseExporter = new DatabaseExport();
    $this->product = Settings::get('product');
  }

  public function doBatch() {
    $connection = $this->database->getConnectionOptions();

    $tables = $this->databaseExporter->getTables(
      $connection['host'],
      $connection['username'],
      $connection['password'],
      $connection['database'],
      ['batch*', 'cache*', 'flood', 'webcomposer_audit', 'webform_submission']
    );

    $guid = md5(time() . rand() . uniqid());

    foreach ($tables as $table) {
      $operations[] = [
        [$this, 'doProcessTable'],
        [$table, $connection, $guid],
      ];
    }

    $batch = [
      'title' => t('Exporting Database'),
      'operations' => $operations,
      'finished' => [$this, 'doProcessFinish'],
    ];

    batch_set($batch);
  }

  public function doProcessTable($table, $connection, $guid, &$context) {
    if (!isset($context['result']['guid'])) {
      $context['results']['guid'] = $guid;
    }

    if (!isset($context['results']['dumps'])) {
      $context['results']['dumps'] = [];
    }

    $dump = $this->databaseExporter->processTable(
      $table,
      $connection['host'],
      $connection['username'],
      $connection['password'],
      $connection['database']
    );

    $tempfile = tempnam(sys_get_temp_dir(), "$table--$guid--database-export");

    file_put_contents($tempfile, $dump);

    $context['results']['dumps'][] = $tempfile;
  }

  public function doProcessFinish($success, $results, $operations) {
    $connection = $this->database->getConnectionOptions();

    $prefix = $this->databaseExporter->preExport($connection['database']);
    $dump = $this->doRecreateDump($results['dumps']);
    $suffix = $this->databaseExporter->postExport();

    $dump = $prefix . $dump . $suffix;

    $this->doCreateDownload($dump);
  }

  private function doRecreateDump($files) {
    $dump = NULL;

    foreach ($files as $file) {
      $dump = $dump . file_get_contents($file);
    }

    return $dump;
  }

  private function doCreateDownload($dump) {
    $date = date('m-d-Y--H-i-s');

    if ($this->product) {
      $date = $this->product . '--' . $date;
    }

    $file = file_save_data($dump, "public://database-export-$date.sql");
    $file->setTemporary();
    $file->save();

    $path = Url::fromUri($file->url());

    $_SESSION['webcomposer_dashboard_database_export_download'] = $path->getUri();
  }
}
