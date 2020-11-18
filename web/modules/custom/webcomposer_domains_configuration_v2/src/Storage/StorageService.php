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
    $lang = 'en'; // TODO: This will force to set the language to en, remove until further notice
    $storageTokens = $this->storage->getTokens();
    $storageGroups = $this->storage->getGroups();
    $storageDomains = [];

    array_walk($storageGroups, function ($domains, $group) use (&$storageDomains, $lang) {
      $group = str_replace('groups:', '', $group);
      array_walk($domains, function($domain) use (&$storageDomains, $group, $lang) {
        $storageDomains[$group][$domain] = $this->storage->getDomains($domain, $lang);
      });
    });;

    // Start Transaction
    $this->storage->createTransaction();

    // Prepare data
    $tokens = $data[ImportParser::TOKEN_COLUMN] ?? [];
    $domains = array_filter($data, function ($sheetName) {
      return $sheetName !== ImportParser::TOKEN_COLUMN;
    }, ARRAY_FILTER_USE_KEY);

    // 1 - Save tokens
    $this->storage->setTokens($tokens);
    $clearedTokens = $this->storage->clearTokens($tokens, $storageTokens);

    // 2 - Save Groups
    $this->storage->setGroups($domains);
    $this->storage->clearGroups($domains, $storageDomains);

    // 3 - Save Domains
    $this->storage->setDomains($domains, $lang);
    $this->storage->clearDomains($domains, $storageDomains, $lang, $clearedTokens);

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

  public function getGroups() {
    return $this->storage->getGroups();
  }

}
