<?php

namespace Drupal\webcomposer_audit_export\Parser;

use Drupal\Core\DependencyInjection\DependencySerializationTrait;

/**
 * Class for parsing Domains data to excel object.
 *
 * @package Webcomposer Domain Import
 */
class ExportParser {

    use DependencySerializationTrait;

  /**
   * Returns an array of all domain groups, where the index is the primary key `id`.
   *
   * @param array $filters
   *   - Audit log filters.
   */
  public function get_audit_logs($filters = [], $options = []) {
    $storage = \Drupal::service('webcomposer_audit.database_storage');
    return $storage->getWithOffset([
      'limit' => 500,
      'offset' => $options['offset'] ?? 0,
      'where' => $filters,
      'orderby' => [
        'field' => 'timestamp',
        'sort' => 'DESC',
      ],
    ]);
  }

  /**
   * Returns an array of all domain groups, where the index is the primary key `id`.
   *
   * @param array $filters
   *   - Audit log filters.
   */
  public function get_audit_count($filters = [], $options = []) {
    $storage = \Drupal::service('webcomposer_audit.database_storage');
    return $storage->getDistinct('id', [
      'limit' => 20000,
      'where' => $filters,
      'orderby' => [
        'field' => 'timestamp',
        'sort' => 'DESC',
      ],
    ]);
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

    foreach ($logs as $key => $value) {
      $result[$key] = [
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
