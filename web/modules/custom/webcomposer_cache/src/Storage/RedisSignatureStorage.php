<?php

namespace Drupal\webcomposer_cache\Storage;

use Drupal\Core\Site\Settings;
use Predis\Client as Redis;

class RedisSignatureStorage implements SignatureStorageInterface {
  /**
   * The cache key
   *
   * @var string
   */
  private $cacheKey;

  /**
   * Predis client instance
   */
  private $redis;

  /**
   * The product code
   *
   * @var string
   */
  private $product;

  /**
   * Public constructor
   */
  public function __construct() {
    $product = Settings::get('product');

    $this->cacheKey = "cache:signature:drupal:$product";

    $settings = Settings::get('webcomposer_cache');

    if (!empty($settings['redis'])) {
      $this->redis = new Redis($settings['redis']['clients'], $settings['redis']['options']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getSignature() {
    $signature = NULL;

    try {
      if ($this->redis) {
        $signature = $this->redis->get($this->cacheKey);

        if (!$signature) {
          $signature = $this->renewSignature();
        }
      }
    } catch (\Exception $e) {
      // do nothing
    }

    return $signature;
  }

  /**
   * {@inheritdoc}
   */
  public function setSignature($signature) {
    $this->redis->set($this->cacheKey, $signature);
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
   * {@inheritdoc}
   */
  public function deleteSignature() {
    $this->redis->del($this->cacheKey);
  }

  /**
   * Creates a new signature
   */
  private function createSignature() {
    return md5(time());
  }
}
