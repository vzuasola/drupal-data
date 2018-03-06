<?php

namespace Drupal\webcomposer_audit\Storage;

use Drupal\Core\Entity\EntityInterface;

/**
 *
 */
class DatabaseAuditStorage implements AuditStorageInterface {
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
      ->select('webcomposer_audit', 'w')
      ->extend('\Drupal\Core\Database\Query\PagerSelectExtender')
      ->extend('\Drupal\Core\Database\Query\TableSortExtender');

    $query->fields('w', [
      'id',
      'uid',
      'entity',
      'eid',
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
   * {@inheritdoc}
   */
  public function get($id) {
    return $this->database
      ->select('webcomposer_audit', 'w')
      ->fields('w', [
        'id',
        'uid',
        'entity',
        'eid',
        'action',
        'title',
        'location',
        'timestamp',
      ])
      ->condition('w.id', $id)
      ->execute()
      ->fetchAssoc();
  }

  /**
   * {@inheritdoc}
   */
  public function insert(EntityInterface $entity) {
    $id = $entity->id();

    try {
      $this->database
        ->insert('webcomposer_audit')
        ->fields([
          'uid' => $this->user->id(),
          'entity' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::ADD,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
        ])
        ->execute();
    }
    catch (\Exception $e) {
      // do nothing
    }
  }

  /**
   * {@inheritdoc}
   */
  public function update(EntityInterface $entity, EntityInterface $preEntity) {
    $id = $entity->id();

    try {
      $this->database
        ->insert('webcomposer_audit')
        ->fields([
          'uid' => $this->user->id(),
          'entity' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::UPDATE,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
        ])
        ->execute();
    }
    catch (\Exception $e) {
      // do nothing
    }
  }

  /**
   * {@inheritdoc}
   */
  public function delete(EntityInterface $entity) {
    $id = $entity->id();

    try {
      $this->database
        ->insert('webcomposer_audit')
        ->fields([
          'uid' => $this->user->id(),
          'entity' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::DELETE,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
        ])
        ->execute();
    }
    catch (\Exception $e) {
      // do nothing
    }
  }

  /**
   * {@inheritdoc}
   */
  public function truncate() {
    return true;
  }
}
