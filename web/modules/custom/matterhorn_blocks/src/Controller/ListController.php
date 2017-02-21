<?php

namespace Drupal\matterhorn_blocks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\matterhorn_blocks\Plugin\MatterhornBlocksPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ListController.
 *
 * @package Drupal\matterhorn_blocks\Controller
 */
class ListController extends ControllerBase
{
    /**
     * The matterhorn blocks plugin manager
     */
    protected $matterhornBlocksManager;

    /**
     * Constructor.
     *
     * @param MatterhornBlocksPluginManager $matterhornBlocksManager
     *   The Plugin Manager
     */
    public function __construct(MatterhornBlocksPluginManager $matterhornBlocksManager)
    {
        $this->matterhornBlocksManager = $matterhornBlocksManager;
    }

    /**
     * Show.
     *
     * @return string
     *   Return Hello string.
     */
    public function show($name)
    {
        return array(
            '#type' => 'markup',
            '#markup' => $this->t('Implement method: show with parameter(s): $name'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) 
    {
        return new static($container->get('plugin.manager.matterhorn_blocks_plugin'));
    }
}
