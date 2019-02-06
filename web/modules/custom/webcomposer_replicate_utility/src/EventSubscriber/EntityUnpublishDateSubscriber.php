<?php

/**
 * @file
 * Contains \Drupal\webcomposer_replicate_utility\EventSubscriber\EntityUnpublishDateSubscriber.
 */

namespace Drupal\webcomposer_replicate_utility\EventSubscriber;

use Drupal\replicate\Events\ReplicatorEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\replicate\Events\ReplicateAlterEvent;
use Drupal\replicate\Events\AfterSaveEvent;

/**
 * Class EntityUnpublishDateSubscriber.
 *
 * @package Drupal\webcomposer_replicate_utility\EntityStatusSubscriber
 */
class EntityUnpublishDateSubscriber implements EventSubscriberInterface {

  /**
   * Set entity unpublish_date to now
   *
   * @param ReplicateAlterEvent $event
   *   The event we're working on.
   */
  public function onClone(ReplicateAlterEvent $event) {
    $entity = $event->getEntity();
    
    if ($entity->hasField('field_unpublish_date')) {
      $date = gmdate("Y-m-d\TH:i:s", time());
      $entity->set('field_unpublish_date', ['value' => $date]);
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
