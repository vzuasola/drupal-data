<?php

namespace Drupal\webcomposer_config_schema\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Webcomposer Configuration Plugin item annotation object.
 *
 * @see \Drupal\webcomposer_config_schema\Plugin\WebcomposerConfigPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class WebcomposerConfigPlugin extends Plugin {
  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The route settings
   *
   * @var array
   */
  public $route;

  /**
   * The menu link settings
   *
   * @var array
   */
  public $menu;
}
