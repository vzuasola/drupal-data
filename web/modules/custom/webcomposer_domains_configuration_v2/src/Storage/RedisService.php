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
    $redisTokens = array_keys($this->getTokens());
    $keys = array_keys($data);

    $keysDiff = array_diff($redisTokens, $keys);
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
    $redisGroups = $this->getGroups();
    if(!$redisGroups) {
      return;
    }

    // Delete Entire Group If removed from new import
    $keysDiff = array_diff(array_keys($redisGroups), $groups);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }

    // Removed domains not included on the group
    foreach($data as $groupKey => $groupData) {
      $redisDomains = $redisGroups[$groupKey] ?? [];
      $importDomains = array_keys($groupData);
      $domainDiff = array_diff($redisDomains, $importDomains);
      if($domainDiff) {
        array_walk($domainDiff, function ($domain) use ($groupKey) {
          $this->redis->srem($groupKey, $domain);
        });
      }
    }
  }

  public function setGroups(array &$data) {
    $parsedData = [];
    foreach ($data as $group => $domainList) {
      $groupKey = self::GROUP_NAMESPACE . ":{$group}";
      $this->redis->sadd($groupKey, array_keys($domainList));

      $parsedData[$groupKey] = $domainList;
    }
    $data = $parsedData;
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
    $importDomains = [];

    array_walk($redisGroups, function ($domains) use (&$redisDomains, $lang, $clearedTokens) {
      array_walk($domains, function (&$domain) use ($lang, $clearedTokens) {
        $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
        if($clearedTokens) {
          // Clear Updated tokens from hash
          $this->redis->hdel($domain, $clearedTokens);
        }
      });
      $redisDomains = array_merge($redisDomains, $domains);
    });

    array_walk($data, function ($group) use (&$importDomains) {
      $domains = array_keys($group);
      $importDomains = array_merge($importDomains, $domains);
    });

    $keysDiff = array_diff($redisDomains, $importDomains);

    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }
  }

  public function setDomains(array &$data, string $lang) {
    $parsedData = [];
    foreach ($data as $group => $domainList) {
      foreach ($domainList as $domain => $domainData) {
        $domainKey = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
        $this->redis->hmset($domainKey, $domainData);
        $parsedData[$group][$domainKey] = $domainData;
      }
    }
    $data = $parsedData;
  }

  public function getDomains(string $domain, string $lang = self::DEFAULT_LANG): array {
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}");
  }
}
