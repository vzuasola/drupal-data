<?php

namespace Drupal\webcomposer_audit_export\Parser;

/**
 * Class for parsing Domains data to excel object.
 *
 * @package Webcomposer Domain Import
 */
class ExportParser {

  /**
   * Returns an array of all domain groups, where the index is the primary key `id`.
   */
  public function get_audit_logs() {
    $storage = \Drupal::service('webcomposer_audit_export.database_storage');

    return $storage->all([]);

  }

  /**
   * Converts a column based format array to row based PHP excel readable array.
   *
   * @param array $columns
   *   - a column based format array.
   *
   * @return array $result
   */
  public function excel_filter_column($columns) {
    $result = [];

    foreach ($columns as $column_key => $column_data) {
      foreach ($column_data as $row_key => $row_data) {
        $result[$row_key][$column_key] = $row_data;
      }
    }

    return $result;
  }

  /**
   * Generates the domain groups worksheet data.
   *
   * @param array $groups
   *   - the domain groups fetched from the database.
   *
   * @return array $result
   */
  public function excel_get_audit_logs($logs) {
    $result = [];

    $header = [
      'title' => 'TITLE',
      'type' => 'TYPE',
      'action' => 'ACTION',
      'user' => 'USER',
      'date' => 'DATE',
      'language' => 'LANGUAGE',
      'entity_before' => 'ENTITY BEFORE',
      'entity_after' => 'ENTITY AFTER',
    ];

    $result[0] = $header;

    foreach ($logs as $key => $value) {
      $count = $key + 1;

      $result[$count] = [
        'title' => $value['title'],
        'type' => $value['type'],
        'action' => $value['action'],
        'user' => $value['user'],
        'date' => $value['date'],
        'language' => $value['language'],
        'entity_before' => $value['entity_before'],
        'entity_after' => $value['entity_after'],
      ];
    }

    return $result;
  }

}
