<?php

namespace Drupal\webcomposer_cache\Storage;

use Drupal\Core\Site\Settings;
use Predis\Client as Redis;

class RedisSignatureStorage implements SignatureStorageInterface {
  /**
   * The cache key
   */
  const CACHE_KEY = 'cache:signature:drupal';

  /**
   * Predis client instance
   */
  private $redis;

  /**
   * Public constructor
   */
  public function __construct() {
    $settings = Settings::get('webcomposer_cache');

    if (!empty($settings['redis'])) {
      $this->redis = new Redis($settings['redis']['clients'], $settings['redis']['options']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getSignature() {
    try {
      $signature = $this->redis->get(self::CACHE_KEY);

      if (!$signature) {
        $signature = $this->renewSignature();
      }
    } catch (\Exception $e) {
      // if signature cannot be created, just return a new signature
      $signature = $this->createSignature();
    }

    return $signature;
  }

  /**
   * {@inheritdoc}
   */
  public function setSignature($signature) {
    $this->redis->set(self::CACHE_KEY, $signature);
  }

  /**
   * {@inheritdoc}
   */
  public function renewSignature() {
    $signature = $this->createSignature();
    $this->setSignature($signature);

    return $signature;
  }

  /**
   * Creates a new signature
   */
  private function createSignature() {
    return md5(time());
  }
}
