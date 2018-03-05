<?php

namespace Drupal\webcomposer_audit\Storage;

use Drupal\Core\Entity\EntityInterface;

/**
 *
 */
class DatabaseAuditStorage implements AuditStorageInterface {
  private $entities = [];

  /**
   *
   */
  public function __construct($database, $user) {
    $this->database = $database;
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public function all($options = []) {
    $query = $this->database
      ->select('webcomposer_audit', 'w')
      ->extend('\Drupal\Core\Database\Query\PagerSelectExtender')
      ->extend('\Drupal\Core\Database\Query\TableSortExtender');

    $query->fields('w', [
      'id',
      'uid',
      'entity',
      'action',
      'title',
      'location',
      'timestamp',
    ]);

    $query->leftJoin('users_field_data', 'ufd', 'w.uid = ufd.uid');

    $result = $query
      ->limit(50)
      ->orderByHeader($options['header'])
      ->execute();

    return $result;
  }

  /**
   * Adds the presave data
   */
  public function preSave($entity) {
    $this->entities[$entity->id()] = $entity;
  }

  /**
   * {@inheritdoc}
   */
  public function add(EntityInterface $entity) {
    $id = $entity->id();

    if (isset($this->entities[$id])) {
      try {
        $this->database
          ->insert('webcomposer_audit')
          ->fields([
            'uid' => $this->user->id(),
            'entity' => $entity->getEntityTypeId(),
            'action' => AuditStorageInterface::UPDATE,
            'title' => $entity->label(),
            'location' => 'Drupal admin',
            'timestamp' => time(),
          ])
          ->execute();
      }
      catch (\Exception $e) {
        // do nothing
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function truncate() {
    return true;
  }
}
