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
  public function set_FOOBAR(string $key, array $data, string $lang);

  /**
   * Retrieves the data using the provided key
   *
   * @param string $key
   * @param string $lang
   * @return mixed
   */
  public function get_FOOBAR(string $key, string $lang);

  public function createTransaction();

  public function commitTransaction();

  public function clearAll(array $data);

  public function setTokens($data);
  public function getTokens();

  public function setGroups($data);
  public function getGroups(string $group);

  public function setDomains($data, $lang);
  public function getDomains(string $domain, string $lang);
}
