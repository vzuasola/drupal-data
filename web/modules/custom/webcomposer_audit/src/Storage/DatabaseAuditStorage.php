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
    $query = $this->database->select(self::TABLE, 'w');

    if (isset($options['extend'])) {
      foreach ($options['extend'] as $extend) {
        $query = $query->extend($extend);
      }
    }

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

    if (isset($options['where'])) {
      foreach ($options['where'] as $key => $value) {
        if (is_array($value)) {
          $query->condition("w.$key", $value['value'], $value['operator']);
        } else {
          $query->condition("w.$key", "%$value%", 'like');
        }
      }
    }

    if (!isset($options['limit'])) {
      $options['limit'] = 50;
    }

    if (isset($options['header'])) {
      $query->orderByHeader($options['header']);
    }

    if (isset($options['orderby'])) {
      $query->orderBy($options['orderby']['field'], $options['orderby']['sort']);
    }

    if (isset($options['offset'])) {
      $query->range($options['offset'], $options['limit']);
    } elseif (isset($options['limit'])) {
      $query->limit($options['limit']);
    }

    $result = $query->execute();

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getDistinct($column, $options = []) {
    $data = [];

    $query = $this->database
      ->select(self::TABLE, 'w')
      ->fields('w', [$column])
      ->distinct();

    if (isset($options['orderby'])) {
      $query->orderBy($options['orderby']['field'], $options['orderby']['sort']);
    }

    if (isset($options['where'])) {
      foreach ($options['where'] as $key => $value) {
        if (is_array($value)) {
          $query->condition("w.$key", $value['value'], $value['operator']);
        } else {
          $query->condition("w.$key", "%$value%", 'like');
        }
      }
    }

    if (!isset($options['limit'])) {
      $options['limit'] = 50;
    }

    $result = $query
      ->range(0, $options['limit'])
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
   *
   */
  public function getCount($options = []) {
    $records = $this->getDistinct('id', $options);

    return count($records);
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
        ->delete(self::TABLE)
        ->condition('id', $id)
        ->execute();
    }
    catch (\Exception $e) {
      // do nothing
    }
  }

  /**
   * {@inheritdoc}
   */
  public function deleteByIds(array $entityIds): int {

    try {
      return $this->database
        ->delete(self::TABLE)
        ->condition('id', $entityIds, 'IN')
        ->execute();
    }
    catch (\Exception $e) {
      // do nothing
    }

    return false;
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
