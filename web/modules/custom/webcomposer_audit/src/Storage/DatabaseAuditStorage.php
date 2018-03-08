<?php

namespace Drupal\webcomposer_audit\Storage;

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
    ]);

    $query->leftJoin('users_field_data', 'ufd', 'w.uid = ufd.uid');

    if (isset($options['where'])) {
      foreach ($options['where'] as $key => $value) {
        $query->condition($key, "%$value%", 'like');
      }
    }

    $result = $query
      ->limit(50)
      ->orderByHeader($options['header'])
      ->execute();

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getDistinct($column, $options = []) {
    $data = [];

    $result = $this->database
      ->select(self::TABLE, 'w')
      ->fields('w', [$column])
      ->distinct()
      ->execute()
      ->fetchAllAssoc($column);

    if ($result) {
      $data = array_keys($result);
      $data = array_combine($data, $data);
    }

    if (isset($options['callback'])) {
      array_walk($data, $options['callback']);
    }

    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function get($id) {
    return $this->database
      ->select(self::TABLE, 'w')
      ->fields('w', [
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
        ->insert(self::TABLE)
        ->fields([
          'uid' => $this->user->id(),
          'type' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::ADD,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
          'language' => \Drupal::languageManager()->getCurrentLanguage()->getId(),
          'entity' => serialize($entity),
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
  public function update(EntityInterface $entity) {
    $id = $entity->id();

    try {
      $this->database
        ->insert(self::TABLE)
        ->fields([
          'uid' => $this->user->id(),
          'type' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::UPDATE,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
          'language' => \Drupal::languageManager()->getCurrentLanguage()->getId(),
          'entity' => serialize($entity),
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
        ->insert(self::TABLE)
        ->fields([
          'uid' => $this->user->id(),
          'type' => $entity->getEntityTypeId(),
          'eid' => $id,
          'action' => AuditStorageInterface::DELETE,
          'title' => $entity->label(),
          'location' => $this->path->getPath(),
          'timestamp' => time(),
          'language' => \Drupal::languageManager()->getCurrentLanguage()->getId(),
          'entity' => serialize($entity),
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
    $this->database
      ->truncate(self::TABLE)
      ->execute();
  }
}
