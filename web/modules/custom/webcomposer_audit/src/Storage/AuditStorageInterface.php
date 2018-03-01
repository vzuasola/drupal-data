<?php

namespace Drupal\webcomposer_audit\Storage;

/**
 *
 */
interface AuditStorageInterface {
  /**
   *
   */
  public function all();

  /**
   *
   */
  public function add($index, $data);

  /**
   *
   */
  public function truncate();
}
