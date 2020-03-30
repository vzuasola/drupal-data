<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

/**
 * Interface StorageInterface.
 */
interface StorageInterface
{
  public function set(string $key, array $data);

  public function get(string $key);
}
