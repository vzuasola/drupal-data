<?php

namespace Drupal\matterhorn_blocks\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Matterhorn blocks plugin item annotation object.
 *
 * @see \Drupal\matterhorn_blocks\Plugin\MatterhornBlocksPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class MatterhornBlocksPlugin extends Plugin
{
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
