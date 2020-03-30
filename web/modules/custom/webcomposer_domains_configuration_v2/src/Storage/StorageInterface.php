<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

/**
 * Interface StorageInterface.
 */
interface StorageInterface
{
  /**
   * Stores the data using the provided key
   *
   * @param string $key
   * @param array $data
   * @return bool
   */
  public function set(string $key, array $data);

  /**
   * Retrieves the data using the provided key
   *
   * @param string $key
   * @return mixed
   */
  public function get(string $key);
}
