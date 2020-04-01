<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal\Core\Site\Settings;
use Predis\Client as Redis;

/**
 * Class RedisService.
 */
class RedisService implements StorageInterface {

  protected const DEFAULT_LANG = "en";

  /**
   * @var Redis
   */
  private $redis;

  /**
   * Constructs a new RedisService object.
   */
  public function __construct()
  {
    $this->redis = $this->createRedisInstance();
  }

  /** @inheritDoc */
  public function set(string $key, array $data, string $lang = self::DEFAULT_LANG)
  {
    if ($lang) {
      $lang = ":" . $lang;
    }
    return $this->redis->hmset($key . $lang, $data);
  }

  /** @inheritDoc */
  public function get(string $key, string $lang = self::DEFAULT_LANG)
  {
    if ($lang) {
      $lang = ":" . $lang;
    }
    return $this->redis->hgetall($key . $lang);
  }

  public function createTransaction()
  {
    $this->redis->multi();
  }

  public function commitTransaction()
  {
    $this->redis->exec();
  }

  public function getAll()
  {
    // TODO: Implement getAll() method.
  }

  public function clearAll(?array $keys)
  {
    // Create a new redis instance this is to handle if
    // there is a multi transaction on the constructed
    // redis instance it will still provide keys
    $redis = $this->createRedisInstance();
    foreach ($keys as $key) {
      $keysFound = $redis->keys($key);
      $this->redis->del($keysFound);
    }
    $redis->quit(); // Close the newly created redis instance
  }

  private function createRedisInstance()
  {
    $settings = Settings::get('webcomposer_domains_configuration_v2')['redis'];
    return new Redis(
      $settings['clients'],
      $settings['options']
    );
  }
}
