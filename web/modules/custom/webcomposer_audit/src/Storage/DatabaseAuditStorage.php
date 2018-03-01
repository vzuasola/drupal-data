<?php

namespace Drupal\webcomposer_audit\Storage;

/**
 *
 */
class DatabaseAuditStorage implements AuditStorageInterface {
  /**
   * {@inheritdoc}
   */
  public function all() {
    $data = [];

    for ($i = 1; $i < 100; $i++) { 
      $item = [
        'action' => 'Update',
        'type' => 'Node',
        'name' => "Node $i",
        'previous' => [
        ],
        'current' => [
        ],
      ];

      $data[$i] = $item;
    }
    
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function add($index, $data) {
    return true;
  }

  /**
   * {@inheritdoc}
   */
  public function truncate() {
    return true;
  }
}
