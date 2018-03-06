<?php

namespace Drupal\webcomposer_audit\Storage;

use Drupal\Core\Entity\EntityInterface;

/**
 *
 */
interface AuditStorageInterface {
  /**
   * List of all available actions
   */
  const ACTIONS = [
    self::ADD,
    self::UPDATE,
    self::DELETE,
  ];

  /**
   * Individual actions
   */
  const ADD = 'add';
  const UPDATE = 'update';
  const DELETE = 'delete';

  /**
   * Fetches all log entries
   *
   * @return Iterable
   */
  public function all();

  /**
   * Gets a log entry data
   *
   * @param integer $id
   *
   * @return array
   */
  public function get($id);

  /**
   *
   */
  public function insert(EntityInterface $entity);

  /**
   *
   */
  public function update(EntityInterface $entity, EntityInterface $preEntity);

  /**
   *
   */
  public function delete(EntityInterface $entity);

  /**
   *
   */
  public function truncate();
}
