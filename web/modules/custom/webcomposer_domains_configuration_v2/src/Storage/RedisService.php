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
    $keysFound = array_keys($this->getTokens());
    $keys = array_keys($data);

    $keysDiff = array_diff($keysFound, $keys);
    if ($keysDiff) {
      $this->redis->hdel(self::TOKEN_NAMESPACE, $keysDiff);
    }

    return $keysDiff;
  }

  public function setTokens(array $data) {
    $this->redis->hmset(self::TOKEN_NAMESPACE, $data);
  }

  public function getTokens(): array {
    $redis = $this->createRedisInstance();
    return $redis->hgetall(self::TOKEN_NAMESPACE);
  }

  public function clearGroups(array $data) {
    $groups = array_keys($data);
    $keysFound = $this->getGroups();
    if(!$keysFound) {
      return;
    }

    array_walk($groups, function (&$key) {
      $key = self::GROUP_NAMESPACE . ":{$key}";
    });

    // Delete Entire Group If removed from new import
    $keysDiff = array_diff(array_keys($keysFound), $groups);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }

    // Removed domains not included on the group
    foreach($keysFound as $groupKey => $redisDomains) {
      $importDomains = array_keys($data[str_replace(self::GROUP_NAMESPACE . ":", "", $groupKey)] ?? []);
      $domainDiff = array_diff($redisDomains, $importDomains);
      if($domainDiff) {
        array_walk($domainDiff, function ($domain) use ($groupKey) {
          $this->redis->srem($groupKey, $domain);
        });
      }
    }
  }

  public function setGroups(array $data) {
    foreach ($data as $group => $domainList) {
      $this->redis->sadd(self::GROUP_NAMESPACE . ":{$group}", array_keys($domainList));
    }
  }

  public function getGroups(): array {
    $redis = $this->createRedisInstance();
    $groupsKey = [];
    do {
      list($cursor, $key) = $redis->scan($cursor ?? 0,
        ['match' => self::GROUP_NAMESPACE . ":*"]);
      if ($key) {
        foreach ($key as $group) {
          $groupsKey[$group] = $redis->smembers($group);
        }
      }
      $done = (intval($cursor) === 0);
    } while (!$done);
    return $groupsKey;
  }

  public function clearDomains(array $data, string $lang, array $clearedTokens) {
    $redisGroups = $this->getGroups();
    $redisDomains = [];
    foreach ($redisGroups as $group => $domains) {
      $redisDomains = array_merge($redisDomains, $domains);
    }

    array_walk($redisDomains, function(&$domain) use ($lang) {
      $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
    });

    $domains = [];
    array_walk($data, function ($group) use (&$domains) {
      $domains = array_merge($domains, array_keys($group));
    });
    array_walk($domains, function (&$domain) use ($lang, $clearedTokens) {
      $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
      if($clearedTokens) {
        // Clear Updated tokens from hash
        $this->redis->hdel($domain, $clearedTokens);
      }
    });

    $keysDiff = array_diff($redisDomains, $domains);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }
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
