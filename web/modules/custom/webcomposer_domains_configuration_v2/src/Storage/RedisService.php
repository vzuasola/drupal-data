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

  public function set_FOOBAR(string $key, array $data, string $lang = self::DEFAULT_LANG) {
    if ($lang) {
      $lang = ":" . $lang;
    }

    return ($this->isHash($data)
      ? $this->redis->hmset($key . $lang, $data)
      : $this->redis->set($key, json_encode($data)));
  }

  public function get_FOOBAR(string $key, string $lang = self::DEFAULT_LANG) {
    if ($lang) {
      $lang = ":" . $lang;
    }
    return $this->redis->hgetall($key . $lang);
  }

  public function createTransaction() {
    $this->redis->multi();
  }

  public function commitTransaction() {
    $this->redis->exec();
  }

  public function clearAll(array $data) {
    // Clear Tokens

    // Clear Groups

    // Clear Domains
  }

  private function createRedisInstance() {
    $settings = Settings::get('webcomposer_domains_configuration_v2')['redis'];
    return new Redis(
      $settings['clients'],
      $settings['options']
    );
  }

  private function isHash($data) {
    if (array() === $data) return false;
    return array_keys($data) !== range(0, count($data) - 1);
  }

  public function setTokens($data) {
    $this->redis->hmset(self::TOKEN_NAMESPACE, $data);
  }

  public function getTokens() {
    return $this->redis->hgetall(self::TOKEN_NAMESPACE);
  }

  public function setGroups($data) {
    foreach ($data as $group => $domainList) {
      $domains = array_keys($domainList);
      $this->redis->set(self::GROUP_NAMESPACE . ":{$group}", json_encode($domains));
    }
  }

  public function getGroups(string $group) {
    return $this->redis->get(self::GROUP_NAMESPACE . ":{$group}");
  }

  public function setDomains($data, $lang) {
    foreach ($data as $group => $domainList) {
      foreach ($domainList as $domain => $domainData) {
        $this->redis->hmset(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}", $domainData);
      }
    }
  }

  public function getDomains(string $domain, string $lang = self::DEFAULT_LANG) {
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":{$domain}:{$lang}");
  }
}
