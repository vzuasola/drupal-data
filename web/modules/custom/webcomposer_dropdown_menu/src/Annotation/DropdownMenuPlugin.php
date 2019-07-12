<?php

namespace Drupal\webcomposer_dropdown_menu\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Dropdown Menu item annotation object.
 *
 * @see \Drupal\webcomposer_dropdown_menu\Plugin\DropdownMenuPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class DropdownMenuPlugin extends Plugin {
  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;
}
