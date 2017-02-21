<?php

namespace Drupal\matterhorn_blocks\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
* Provides the Matterhorn blocks plugin plugin manager.
*/
class MatterhornBlocksPluginManager extends DefaultPluginManager
{
    /**
     * Constructor for MatterhornBlocksPluginManager objects.
     *
     * @param \Traversable $namespaces
     *   An object that implements \Traversable which contains the root paths
     *   keyed by the corresponding namespace to look for plugin implementations.
     * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
     *   Cache backend instance to use.
     * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
     *   The module handler to invoke the alter hook with.
     */
    public function __construct(
        \Traversable $namespaces, 
        CacheBackendInterface $cache_backend, 
        ModuleHandlerInterface $module_handler
    ) {
        parent::__construct(
            'Plugin/Matterhorn/Blocks', 
            $namespaces, 
            $module_handler, 
            'Drupal\matterhorn_blocks\Plugin\MatterhornBlocksPluginInterface', 
            'Drupal\matterhorn_blocks\Annotation\MatterhornBlocksPlugin'
        );

        $this->alterInfo('matterhorn_blocks_matterhorn_blocks_plugin_info');
        $this->setCacheBackend($cache_backend, 'matterhorn_blocks_matterhorn_blocks_plugin_plugins');
    }
}
