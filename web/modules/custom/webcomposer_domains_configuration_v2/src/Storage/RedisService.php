<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

/**
 * Class RedisService.
 */
class RedisService implements StorageInterface {

  /**
   * Constructs a new RedisService object.
   */
  public function __construct() {

  }

  public function set(string $key, array $data)
  {
    $data = json_encode($data);
    print("KEY: {$key} \n VALUE: {$data} \n\n" );
  }

  public function get(string $key)
  {
    // TODO: Implement get() method.
  }
}
