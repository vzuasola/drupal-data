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
  protected const DOMAIN_NAMESPACE = "domains:";
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
  public function set(string $key, $data)
  {
    if(is_array($data)) {
      $data = json_encode($data);
    }

    return $this->redis->set(self::DOMAIN_NAMESPACE . $key, $data);
  }

  /** @inheritDoc */
  public function get(string $key)
  {
    $value = $this->redis->get(self::DOMAIN_NAMESPACE . $key);
    $decoded = json_decode($value);

    return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $value;
  }
}
