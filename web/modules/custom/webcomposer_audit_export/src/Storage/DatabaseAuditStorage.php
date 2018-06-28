<?php

namespace Drupal\webcomposer_audit_export\Storage;

use Drupal\Core\Entity\EntityInterface;

/**
 *
 */
class DatabaseAuditStorage implements AuditStorageInterface {
  const TABLE = 'webcomposer_audit';

  /**
   *
   */
  public function __construct($database, $user, $path) {
    $this->database = $database;
    $this->user = $user;
    $this->path = $path;
  }

  /**
   * {@inheritdoc}
   */
  public function all($options = []) {
    $query = $this->database
      ->select(self::TABLE, 'w')
      ->extend('\Drupal\Core\Database\Query\PagerSelectExtender')
      ->extend('\Drupal\Core\Database\Query\TableSortExtender');

    $query->fields('w', [
      'id',
      'uid',
      'type',
      'eid',
      'action',
      'title',
      'location',
      'timestamp',
      'language',
      'entity',
    ])->fields('ufd', [
      'name',
    ]);

    $query->leftJoin('users_field_data', 'ufd', 'w.uid = ufd.uid');

    $result = $query
      ->orderBy('timestamp', 'DESC')
      ->limit(500)
      ->execute();

    return $result;
  }

}
