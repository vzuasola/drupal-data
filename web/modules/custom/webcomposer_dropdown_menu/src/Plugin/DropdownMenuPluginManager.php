<?php

namespace Drupal\webcomposer_dropdown_menu\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Dropdown Menu plugin manager.
 */
class DropdownMenuPluginManager extends DefaultPluginManager {
  /**
   * Constructs a new DropdownMenuPluginManager object.
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
    parent::__construct('Plugin/Webcomposer/DropdownMenu', $namespaces, $module_handler, 'Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginInterface', 'Drupal\webcomposer_dropdown_menu\Annotation\DropdownMenuPlugin');

    $this->alterInfo('webcomposer_dropdown_menu_dropdown_menu_plugin_info');
    $this->setCacheBackend($cache_backend, 'webcomposer_dropdown_menu_dropdown_menu_plugin_plugins');
  }
}
