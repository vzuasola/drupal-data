<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal\Core\Site\Settings;
use Predis\Client as Redis;

class RedisService implements StorageInterface {

  protected const DEFAULT_LANG = "en";
  protected const TOKEN_NAMESPACE = "tokens";
  protected const GROUP_NAMESPACE = "groups";
  protected const DOMAIN_NAMESPACE = "domains";

  /**
   * @var Redis
   */
  private $redis;

  public function __construct() {
    $this->redis = $this->createRedisInstance();
  }

  public function createTransaction() {
    $this->redis->multi();
  }

  public function commitTransaction() {
    $this->redis->exec();
  }

  private function createRedisInstance() {
    $settings = Settings::get('webcomposer_domains_configuration_v2')['redis'];
    return new Redis(
      $settings['clients'],
      $settings['options']
    );
  }

  public function clearTokens(array $data): array {
    $redis = $this->createRedisInstance();
    $keysFound = [];
    do {
      list($cursor, $redisTokens) = $redis->hscan(self::TOKEN_NAMESPACE, $cursor ?? 0);
      $keysFound = array_merge($keysFound, array_keys($redisTokens));
      $done = (intval($cursor) === 0);
    } while (!$done);
    $keys = array_keys($data);

    $keysDiff = array_diff($keysFound, $keys);
    if ($keysDiff) {
      $this->redis->hdel(self::TOKEN_NAMESPACE, $keysDiff);
    }
    $redis->quit();

    return $keysDiff;
  }

  public function setTokens(array $data) {
    $this->redis->hmset(self::TOKEN_NAMESPACE, $data);
  }

  public function getTokens(): array {
    return $this->redis->hgetall(self::TOKEN_NAMESPACE);
  }

  public function clearGroups(array $data) {
    $groups = array_keys($data);
    $redis = $this->createRedisInstance();
    $keysFound = [];
    do {
      list($cursor, $redisGroups) = $redis->scan($cursor ?? 0,
        ['match' => self::GROUP_NAMESPACE . ":*"]);
      $keysFound = array_merge($keysFound, $redisGroups);
      $done = (intval($cursor) === 0);
    } while (!$done);
    array_walk($groups, function (&$key) {
      $key = self::GROUP_NAMESPACE . ":{$key}";
    });

    // Delete Entire Group If removed from new import
    $keysDiff = array_diff($keysFound, $groups);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }

    if($keysFound) {
      // Removed domains not included on the group
      foreach($keysFound as $groupKey) {
        $importDomains = array_keys($data[str_replace(self::GROUP_NAMESPACE . ":", "", $groupKey)] ?? []);
        $cursor = null;
        $redisDomains = [];
        do {
          list($cursor, $domains) = $redis->sscan($groupKey
            , $cursor ?? 0);
          $redisDomains = array_merge($redisDomains, $domains);
          $done = (intval($cursor) === 0);
        } while (!$done);

        $domainDiff = array_diff($redisDomains, $importDomains);
        if($domainDiff) {
          array_walk($domainDiff, function ($domain) use ($groupKey) {
              $this->redis->srem($groupKey, $domain);
          });
        }
      }
    }
    $redis->quit();
  }

  public function setGroups(array $data) {
    foreach ($data as $group => $domainList) {
      $this->redis->sadd(self::GROUP_NAMESPACE . ":{$group}", array_keys($domainList));
    }
  }

  public function getGroups(string $group): string {
    return $this->redis->get(self::GROUP_NAMESPACE . ":{$group}");
  }

  public function clearDomains(array $data, string $lang, array $clearedTokens) {
    $redis = $this->createRedisInstance();
    $keysFound = [];
    do {
      list($cursor, $redisDomains) = $redis->scan($cursor ?? 0,
        ['match' => self::DOMAIN_NAMESPACE . ":*:{$lang}"]
      );
      $keysFound = array_merge($keysFound, $redisDomains);
      $done = (intval($cursor) === 0);
    } while (!$done);

    $domains = [];
    array_walk($data, function ($group) use (&$domains) {
      $domains = array_merge($domains, array_keys($group));
    });
    array_walk($domains, function (&$domain) use ($lang, $clearedTokens) {
      $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
      if($clearedTokens) {
        $this->redis->hdel($domain, $clearedTokens);
      }
    });

    $keysDiff = array_diff($keysFound, $domains);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }
    $redis->quit();
  }

  public function setDomains(array $data, string $lang) {
    foreach ($data as $group => $domainList) {
      foreach ($domainList as $domain => $domainData) {
        $this->redis->hmset(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}", $domainData);
      }
    }
  }

  public function getDomains(string $domain, string $lang = self::DEFAULT_LANG): array {
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}");
  }
}
