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
      $connection['database']
    );

    foreach ($tables as $table) {
      $operations[] = [
        [$this, 'doProcessTable'],
        [$table, $connection],
      ];
    }

    $batch = [
      'title' => t('Exporting Database'),
      'operations' => $operations,
      'finished' => [$this, 'doProcessFinish'],
    ];

    batch_set($batch);
  }

  public function doProcessTable($table, $connection, &$context) {
    if (!isset($context['results']['dump'])) {
      $context['results']['dump'] = $this->databaseExporter->preExport($table);
    }

    $dump = $this->databaseExporter->processTable(
      $table,
      $connection['host'],
      $connection['username'],
      $connection['password'],
      $connection['database']
    );

    $context['results']['dump'] = $context['results']['dump'] . $dump;
  }

  public function doProcessFinish($success, $results, $operations) {
    $dump = $results['dump'];
    $dump = $dump . $this->databaseExporter->postExport();

    $this->doCreateDownload($dump);
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
