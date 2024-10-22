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
   * Predis client instance
   */
  private $redis2;

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

    if (isset($settings['multiple_redis'])) {
      $this->redis = new Redis(
          $settings['multiple_redis']['clients']['redis_odd'],
          $settings['multiple_redis']['options']['redis_odd']
      );
      $this->redis2 = new Redis(
        $settings['multiple_redis']['clients']['redis_even'],
        $settings['multiple_redis']['options']['redis_even']
      );
    } else if (!empty($settings['redis'])) {
      $this->redis = new Redis($settings['redis']['clients'], $settings['redis']['options']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getSignature($renew = true) {
    $signature = NULL;

    try {
      if ($this->redis) {
        $signature = $this->redis->get($this->cacheKey);

        if ($renew && !$signature) {
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
    // calling audit log hook
    \Drupal::service('module_handler')->invokeAll(
      'webcomposer_cache_signature_update',
      [$signature, $this->getSignature(false)]
    );

    $this->redis->set($this->cacheKey, $signature);

    if ($this->redis2) {
      $this->redis2->set($this->cacheKey, $signature);
    }
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

    if ($this->redis2) {
      $this->redis2->del($this->cacheKey);
    }
  }

  /**
   * Creates a new signature
   */
  private function createSignature() {
    return md5(time());
  }
}
