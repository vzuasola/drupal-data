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
   *
   */
  public function all();

  /**
   *
   */
  public function add(EntityInterface $entity);

  /**
   *
   */
  public function update(EntityInterface $entity);

  /**
   *
   */
  public function truncate();
}
