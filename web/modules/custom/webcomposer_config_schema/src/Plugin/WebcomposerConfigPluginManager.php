<?php

namespace Drupal\webcomposer_config_schema\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Webcomposer Configuration Plugin plugin manager.
 */
class WebcomposerConfigPluginManager extends DefaultPluginManager {
  /**
   * Constructs a new WebcomposerConfigPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $interface = 'Drupal\webcomposer_config_schema\Plugin\WebcomposerConfigPluginInterface';
    $annotation = 'Drupal\webcomposer_config_schema\Annotation\WebcomposerConfigPlugin';

    parent::__construct('Form', $namespaces, $module_handler, $interface, $annotation);

    $this->alterInfo('webcomposer_config_schema_webcomposer_config_plugin_info');
    $this->setCacheBackend($cache_backend, 'webcomposer_config_schema_webcomposer_config_plugin_plugins');
  }
}
