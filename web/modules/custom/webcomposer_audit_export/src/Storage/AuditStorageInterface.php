<?php

namespace Drupal\webcomposer_audit_export\Storage;

use Drupal\Core\Entity\EntityInterface;

/**
 *
 */
interface AuditStorageInterface {
  /**
   * List of all available actions
   */

  /**
   * Fetches all log entries
   *
   * @return Iterable
   */
  public function all();
}
