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

    $result = $query
      ->limit($options['limit'])
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
  public function getWithOffset($options = []) {
    $query = $this->database
      ->select(self::TABLE, 'w');

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

    if (!isset($options['offset'])) {
      $options['offset'] = 0;
    }

    if (isset($options['orderby'])) {
      $query->orderBy($options['orderby']['field'], $options['orderby']['sort']);
    }

    $result = $query
      ->range($options['offset'], $options['limit'])
      ->execute();

    return $result;
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
