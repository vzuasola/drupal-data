<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Predis\Client as Redis;

/**
 * Class RedisService.
 */
class RedisService implements StorageInterface {

  /**
   *
   */
  protected const DOMAIN_NAMESPACE = "domains";

  protected const DEFAULT_LANG = "en";

  // TODO: Create a config for this
  /**
   * @var array
   */
  protected $redisConfig = [
    'client' => 'tcp://10.5.0.7:6379',
    'options' => [
      'parameters' => [
        'database' => 2
      ]
    ]
  ];

  /**
   * @var Redis
   */
  private $redis;

  /**
   * Constructs a new RedisService object.
   */
  public function __construct() {
    $this->redis = new Redis($this->redisConfig['client'], $this->redisConfig['options']);
  }

  /** @inheritDoc */
  public function set(string $key, array $data, string $lang = self::DEFAULT_LANG)
  {
    return $this->redis->hmset(self::DOMAIN_NAMESPACE .":" . $key . ":" . $lang,  $data);
  }

  /** @inheritDoc */
  public function get(string $key, string $lang = self::DEFAULT_LANG)
  {
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":" . $key . $lang);
  }
}
