<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal;
use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;

/**
 * Class StorageService.
 */
class StorageService implements StorageInterface {

  /**
   * @var StorageInterface $storage
   */
  private $storage;

  /**
   * Constructs a new StorageService object.
   */
  public function __construct()
  {
    // TODO: Create a switching of storage provider here
    $this->storage = Drupal::service('webcomposer_domains_configuration_v2.redis');
  }

  /**
   * Processes all the data for storing on the storage provider
   *
   * @param array $data
   */
  public function processAllData(array $data)
  {
    // Start Transaction
    $this->createTransaction();

    // Preapare data
    $tokens = $data[ImportParser::TOKEN_COLUMN] ?? [];
    $domains = $this->getDomains($data);

    // 1 - Save tokens
    $this->set("tokens", $tokens, "");
    foreach ($domains as $group => $domainList) {
      // 2 - Save Groups
      $this->set("groups:{$group}", array_keys($domainList), "");
      foreach ($domainList as $domain => $domainData) {
        // 3 - Save Domains
        // TODO: Pass the language parameter
        $lang = 'en'; // TODO: This will force to set the language to en, remove until further notice
        $this->set("domains:{$domain}", $domainData, $lang);
      }
    }

    // 0 - Flush database
    $this->clearAll('tokens', $tokens); // Clear tokens
    $this->clearAll('groups:*', $domains); // Clear Group and Domains
    $this->clearAll('domains:*', $domains); // Clear Group and Domains

    // Commit the transaction changes
    $this->commitTransaction();
  }

  /** @inheritDoc */
  public function set(string $key, array $data, string $lang = 'en')
  {
    // Any Modification per data store should be done here before the actual saving
    return $this->storage->set($key, $data, $lang);
  }

  /** @inheritDoc */
  public function get(string $key, string $lang = 'en')
  {
    return $this->storage->get($key, $lang);
  }

  /**
   * Retrieves the domain list from the sheet/excel data array
   *
   * @param $data
   * @return array
   */
  private function getDomains($data)
  {
    $domains = [];
    foreach ($data as $sheet => $sheetData) {
      if ($sheet !== ImportParser::TOKEN_COLUMN) {
        $domains[$sheet] = $sheetData;
      }
    }

    return $domains;
  }

  public function createTransaction()
  {
    $this->storage->createTransaction();
  }

  public function commitTransaction()
  {
    $this->storage->commitTransaction();
  }

  public function getAll()
  {
    // TODO: Implement getAll() method.
  }

  public function clearAll(string $key, array $data)
  {
    $this->storage->clearAll($key, $data);
  }
}
