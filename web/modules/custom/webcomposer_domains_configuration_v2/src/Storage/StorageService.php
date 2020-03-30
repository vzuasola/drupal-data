<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;
use Drupal\webcomposer_domains_configuration_v2\Service\DomainImportService;

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

  public function processAllData(array $data) {
    // Parsing of data store should be done here
    $domains = $this->getDomains($data);
    foreach ($domains as $domain => $domainData) {
      $this->set($domain, $domainData);
    }
  }

  public function set(string $key, array $data) {
    // Any Modification per data store should be done here before the actual saving
    $this->storage->set($key, $data);
  }

  public function get(string $key)
  {
    return $this->storage->get($key);
  }

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
