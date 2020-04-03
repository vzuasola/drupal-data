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

    return ($this->isHash($data)
      ? $this->redis->hmset($key . $lang, $data)
      : $this->redis->set($key, json_encode($data)));
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

  public function clearAll(string $key, array $data)
  {
    // Create a new redis instance this is to handle if
    // there is a multi transaction on the constructed
    // redis instance it will still provide keys
    $redis = $this->createRedisInstance();
    switch ($key) {
      case "tokens":
        $keysFound = $redis->hkeys($key);

        $keys = array_keys($data);
        break;
      case "groups:*":
        $keysFound = $redis->keys($key);
        $keys = array_keys($data);
        array_walk($keys, function (&$key) {
          $key = "groups:{$key}";
        });

        break;
      default:
        $keysFound = $redis->keys($key);
        array_walk($data, function (&$group) {
          $group = array_keys($group);
        });

        $keys = [];
        foreach ($data as $group) {
          $domains = array_values($group);
          array_walk($domains, function (&$domain) {
            $domain = "domains:{$domain}:en"; // to replace when language is available
          });
          $keys = array_merge($keys, $domains);
        }
    }

    $keysDiff = array_diff($keysFound, $keys);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
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

  private function isHash($data)
  {
    if (array() === $data) return false;
    return array_keys($data) !== range(0, count($data) - 1);
  }
}
