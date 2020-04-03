<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

/**
 * Interface StorageInterface.
 */
interface StorageInterface {
  /**
   * Stores the data using the provided key
   *
   * @param string $key
   * @param array $data
   * @param string $lang
   * @return bool
   */
  public function set(string $key, array $data, string $lang);

  /**
   * Retrieves the data using the provided key
   *
   * @param string $key
   * @param string $lang
   * @return mixed
   */
  public function get(string $key, string $lang);

  public function createTransaction();

  public function commitTransaction();

  public function getAll();

  public function clearAll(string $key, array $data);
}
