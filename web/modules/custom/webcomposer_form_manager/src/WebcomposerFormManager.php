<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Form manager plugin manager.
 */
class WebcomposerFormManager extends DefaultPluginManager {
  /**
   * Constructor for FormManagerManager objects.
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
    parent::__construct('Plugin/Webcomposer/Form', $namespaces, $module_handler, 'Drupal\webcomposer_form_manager\WebcomposerFormInterFace', 'Drupal\webcomposer_form_manager\Annotation\WebcomposerForm');

    $this->alterInfo('webcomposer_form_manager_info');
    $this->setCacheBackend($cache_backend, 'webcomposer_form_manager_plugins');
  }

}
