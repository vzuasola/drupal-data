<?php

/**
 * @file
 * Contains \Drupal\webcomposer_slider_v2\EventSubscriber\SetReplicateDefaultLabel.
 */

namespace Drupal\webcomposer_slider_v2\EventSubscriber;

use Drupal\replicate\Events\ReplicatorEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\replicate\Events\ReplicateAlterEvent;
use Drupal\Core\Entity\TranslatableInterface;

/**
 * Class SetReplicateDefaultLabel.
 *
 * @package Drupal\webcomposer_slider_v2\EventSubscriber
 */
class SetReplicateDefaultLabel implements EventSubscriberInterface {

  /**
   * Updates the field_title with name field.
   *
   * @param ReplicateAlterEvent $event
   *   The event we're working on.
   */
  public function onClone(ReplicateAlterEvent $event) {
    $entity = $event->getEntity();
    $type = $entity->bundle();
    if ($type == 'webcomposer_slider_v2_entity') {
      $title = $entity->get('name')->getString() . ' (Copy)';
      $entity->set('field_title', $title);
      $entity->set('name', '');
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ReplicatorEvents::REPLICATE_ALTER][] = 'onClone';
    return $events;
  }

}
