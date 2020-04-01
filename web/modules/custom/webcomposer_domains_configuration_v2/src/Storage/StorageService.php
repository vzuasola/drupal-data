<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

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
  public function __construct() {
    // TODO: Create a switching of storage provider here
    $this->storage =  \Drupal::service('webcomposer_domains_configuration_v2.redis');
  }

  /**
   * Processes all the data for storing on the storage provider
   *
   * @param array $data
   */
  public function processAllData(array $data) {
    $domains = $this->getDomains($data);
    foreach ($domains as $domain => $domainData) {
      // TODO: Research on redis cli, create transactional update before applying the changes
      // TODO: Pass the language parameter here
      $this->set($domain, $domainData);
    }
  }

  /** @inheritDoc */
  public function set(string $key, array $data, string $lang = 'en') {
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
  private function getDomains($data) {
    $domains = [];
    foreach ($data as $sheet => $sheetData) {
      if($sheet !== ImportParser::TOKEN_COLUMN) {
        $domains = array_merge_recursive($domains, $sheetData);
      }
    }

    return $domains;
  }
}
