<?php

namespace Drupal\webcomposer_domains_configuration_v2\Storage;

use Drupal\Core\Site\Settings;
use Predis\Client as Redis;

/**
 * Class RedisService.
 */
class RedisService implements StorageInterface
{

  protected const DOMAIN_NAMESPACE = "domains";

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
    $settings = Settings::get('webcomposer_domains_configuration_v2')['redis'];
    $this->redis = new Redis(
      $settings['clients'],
      $settings['options']
    );
  }

  /** @inheritDoc */
  public function set(string $key, array $data, string $lang = self::DEFAULT_LANG)
  {
    $lang = self::DEFAULT_LANG; // TODO: This will force to set the language to en, remove until further notice
    return $this->redis->hmset(self::DOMAIN_NAMESPACE . ":" . $key . ":" . $lang, $data);
  }

  /** @inheritDoc */
  public function get(string $key, string $lang = self::DEFAULT_LANG)
  {
    $lang = self::DEFAULT_LANG; // TODO: This will force to set the language to en, remove until further notice
    return $this->redis->hgetall(self::DOMAIN_NAMESPACE . ":" . $key . ":" . $lang);
  }
}
