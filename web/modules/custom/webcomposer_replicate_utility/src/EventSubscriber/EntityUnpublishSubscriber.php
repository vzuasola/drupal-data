<?php

/**
 * @file
 * Contains \Drupal\webcomposer_replicate_utility\EventSubscriber\EntityUnpublishSubscriber.
 */

namespace Drupal\webcomposer_replicate_utility\EventSubscriber;

use Drupal\replicate\Events\ReplicatorEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\replicate\Events\ReplicateAlterEvent;
use Drupal\replicate\Events\AfterSaveEvent;

/**
 * Class EntityUnpublishSubscriber.
 *
 * @package Drupal\webcomposer_replicate_utility\EventSubscriber
 */
class EntityUnpublishSubscriber implements EventSubscriberInterface {

  /**
   * Set field_status to FALSE.
   *
   * @param ReplicateAlterEvent $event
   *   The event we're working on.
   */
  public function onClone(ReplicateAlterEvent $event) {
    $entity = $event->getEntity();
    if ($entity->hasField('field_status')) {
      $entity->set('field_status', 0);
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
