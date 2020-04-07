<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal;
use Drupal\webcomposer_domains_configuration_v2\Parser\ImportParser;

class StorageService {

  /**
   * @var RedisService $storage
   */
  private $storage;

  public function __construct() {
    // TODO: Create a switching of storage provider here
    $this->storage = Drupal::service('webcomposer_domains_configuration_v2.redis');
  }

  public function processImport(array $data) {
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
    $this->storage->clearTokens($tokens);

    // 2 - Save Groups
    $this->storage->setGroups($domains);
    $this->storage->clearGroups(array_keys($domains));

    // 3 - Save Domains
    $this->storage->setDomains($domains, $lang);
    $this->storage->clearDomains($domains, $lang);

    // Commit the transaction changes
    $this->storage->commitTransaction();
  }

  public function getDomain(string $domain, string $lang) {
    $lang = 'en'; // TODO: This will force to set the language to en, remove until further notice
    return $this->storage->getDomains($domain, $lang);
  }

  public function getTokens() {
    return $this->storage->getTokens();
  }

}
