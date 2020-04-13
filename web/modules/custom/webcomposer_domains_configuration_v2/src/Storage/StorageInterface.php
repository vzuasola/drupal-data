<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

/**
 * Interface StorageInterface.
 */
interface StorageInterface {
  public function createTransaction();

  public function commitTransaction();

  public function clearTokens(array $data, array $storageData);

  public function setTokens(array $data);

  public function getTokens(): array;

  public function clearGroups(array $data, array $storageData);

  public function setGroups(array $data);

  public function getGroups(): array;

  public function clearDomains(array $data, array $storageData, string $lang, array $clearedTokens);

  public function setDomains(array $data, string $lang);

  public function getDomains(string $domain, string $lang): array;
}
