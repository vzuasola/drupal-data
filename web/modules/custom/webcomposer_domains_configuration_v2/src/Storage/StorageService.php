<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal;
use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;

class StorageService {

  /**
   * @var StorageInterface | RedisService $storage
   */
  private $storage;

  public function __construct() {
    // TODO: Create a switching of storage provider here
    $this->storage = Drupal::service('webcomposer_domains_configuration_v2.redis');
  }

  public function processAllData(array $data) {
    // Start Transaction
    $this->storage->createTransaction();

    // Prepare data
    $tokens = $data[ImportParser::TOKEN_COLUMN] ?? [];
    $domains = array_filter($data, function ($sheetName) {
      return $sheetName !== ImportParser::TOKEN_COLUMN;
    }, ARRAY_FILTER_USE_KEY);
    $lang = 'en'; // TODO: This will force to set the language to en, remove until further notice

    // 1 - Save tokens
    $this->storage->setTokens($tokens);

    // 2 - Save Groups
    $this->storage->setGroups($domains);

    // 3 - Save Domains
    $this->storage->setDomains($domains, $lang);

    // 4 - Flush Old Data
    $this->storage->clearAll($data); // Clear tokens, Groups, Domains

    // Commit the transaction changes
    $this->storage->commitTransaction();
  }

}
