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

  public function clearTokens(array $data, array $storageData): array {
    if(!$storageData) {
      return [];
    }
    $redisTokens = array_keys($storageData);
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
    $tokens = $redis->hgetall(self::TOKEN_NAMESPACE);
    $redis->quit();

    return $tokens;
  }

  public function clearGroups(array $data, array $storageData) {
    $groups = array_keys($data);
    if(!$storageData) {
      return;
    }

    // Delete Entire Group If removed from new import
    $keysDiff = array_diff(array_keys($storageData), $groups);
    if ($keysDiff) {
      array_walk($keysDiff,function(&$group) {
        $group = self::GROUP_NAMESPACE . ":{$group}";
      });
      $this->redis->del($keysDiff);
    }

    // Removed domains not included on the group
    foreach($data as $groupKey => $groupData) {
      $redisDomains = $storageData[$groupKey] ?? [];
      $importDomains = array_keys($groupData);
      $domainDiff = array_diff(array_keys($redisDomains), $importDomains);
      if($domainDiff) {
        array_walk($domainDiff, function ($domain) use ($groupKey) {
          $this->redis->srem(self::GROUP_NAMESPACE . ":{$groupKey}", $domain);
        });
      }
    }
  }

  public function setGroups(array $data) {
    foreach ($data as $group => $domainList) {
      $groupKey = self::GROUP_NAMESPACE . ":{$group}";
      $this->redis->sadd($groupKey, array_keys($domainList));
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
    $redis->quit();
    return $groupsKey;
  }

  public function clearDomains(array $data, array $storageData, string $lang, array $clearedTokens) {
    $redisDomains = [];
    $importDomains = [];

    array_walk($storageData, function ($domains) use (&$redisDomains, $lang) {
      $domains = array_keys($domains);
      array_walk($domains, function(&$domain) use ($lang){
        $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
      });
      $redisDomains = array_merge($redisDomains, $domains);
    });

    array_walk($data, function ($group) use (&$importDomains, $lang) {
      $domains = array_keys($group);
      array_walk($domains, function(&$domain) use ($lang){
        $domain = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
      });
      $importDomains = array_merge($importDomains, $domains);
    });
    $keysDiff = array_diff($redisDomains, $importDomains);
    if ($keysDiff) {
      $this->redis->del($keysDiff);
    }

    // Clear Updated tokens from hash
    if($clearedTokens) {
      array_walk($importDomains, function($domain) use ($clearedTokens) {
        $this->redis->hdel($domain, $clearedTokens);
      });
    }
  }

  public function setDomains(array $data, string $lang) {
    foreach ($data as $group => $domainList) {
      foreach ($domainList as $domain => $domainData) {
        $domainKey = self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}";
        $this->redis->hmset($domainKey, $domainData);
      }
    }
  }

  public function getDomains(string $domain, string $lang = self::DEFAULT_LANG): array {
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}");
  }
}
