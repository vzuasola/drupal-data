<?php

namespace Drupal\replicate_ui;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\ContentEntityTypeInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteBuildEvent;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Route;

class RouteSubscriber implements EventSubscriberInterface {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Creates a new RouteSubscriber instance.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, ConfigFactoryInterface $config_factory) {
    $this->entityTypeManager = $entityTypeManager;
    $this->configFactory = $config_factory;
  }

  public function onRouteBuild(RouteBuildEvent $event) {
    $config = $this->configFactory->get('replicate_ui.settings');
    $collection = $event->getRouteCollection();
    foreach ($this->entityTypeManager->getDefinitions() as $entity_type_id => $entity_type) {
      if ($entity_type instanceof ContentEntityTypeInterface && in_array($entity_type_id, (array) $config->get('entity_types')) && $entity_type->hasLinkTemplate('canonical') ) {
        $base_path = $entity_type->getLinkTemplate('canonical');
        $path = $base_path . '/replicate';

        $options = [
          'parameters' => [
            $entity_type_id => [
              'type' => 'entity:' . $entity_type_id,
            ],
          ],
        ];

        if ($entity_type_id == 'node') {
          // We delegate the decision of using the admin theme to
          // \Drupal\node\EventSubscriber\NodeAdminRouteSubscriber.
          $options['_node_operation_route'] = TRUE;
        }
        else {
          // Inherit admin route status from the edit route, if it exists.
          $is_admin = FALSE;
          $route_name = "entity.$entity_type_id.edit_form";
          if ($edit_route = $collection->get($route_name)) {
            $is_admin = (bool) $edit_route->getOption('_admin_route');
          }
          $options['_admin_route'] = $is_admin;
        }

        $defaults = [
          '_entity_form' => "$entity_type_id.replicate",
          'entity_type_id' => $entity_type_id,
        ];

        $requirements = [
          '_replicate_access' => 'TRUE',
        ];

        $route = new Route($path, $defaults, $requirements, $options);

        $route_name = "entity.$entity_type_id.replicate";
        $collection->add($route_name, $route);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[RoutingEvents::DYNAMIC][] = 'onRouteBuild';
    return $events;
  }

}
