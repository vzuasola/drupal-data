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

  const SALT = "SUPER SECRET RANDOM STRING...";

  const CIPHER = "aes-128-ctr";

  const HASH_METHOD = "SHA256";


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
    // Parsing of data store should be done here
    $domains = $this->getDomains($data);
    foreach ($domains as $domain => $domainData) {
      // TODO: Research on redis cli, create transactional update before applying the changes
      $this->set($domain, $domainData);
    }
  }

  /** @inheritDoc */
  public function set(string $key, $data) {
    // Any Modification per data store should be done here before the actual saving
    $this->encrypt($key);
    $this->encrypt($data);
    return $this->storage->set($key, $data);
  }

  /** @inheritDoc */
  public function get(string $key)
  {
    $this->encrypt($key);
    $data = $this->storage->get($key);
    $this->decrypt($data);

    return $data;
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

  private function encrypt(&$data)
  {
    if(is_array($data)) {
      $data = json_encode($data);
    }
    $encryptionKey = openssl_digest(self::SALT, self::HASH_METHOD, TRUE);
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    $data = openssl_encrypt($data, self::CIPHER, $encryptionKey, 0, $iv) . "::" . bin2hex($iv);
  }

  private function decrypt(&$data) {
    $encryptionKey = openssl_digest(self::SALT, self::HASH_METHOD, TRUE);
    list($data, $iv) = explode("::", $data);
    $data = openssl_decrypt($data, self::CIPHER, $encryptionKey, 0, hex2bin($iv));
    $decoded = json_decode($data);

    if((json_last_error() === JSON_ERROR_NONE)) {
      $data = $decoded;
    }
  }
}
