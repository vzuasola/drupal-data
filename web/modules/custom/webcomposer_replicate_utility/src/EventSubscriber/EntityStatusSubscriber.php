<?php

/**
 * @file
 * Contains \Drupal\webcomposer_replicate_utility\EventSubscriber\EntityStatusSubscriber.
 */

namespace Drupal\webcomposer_replicate_utility\EventSubscriber;

use Drupal\node\Entity\Node;
use Drupal\replicate\Events\ReplicatorEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\replicate\Events\ReplicateAlterEvent;
use Drupal\replicate\Events\AfterSaveEvent;

/**
 * Class EntityStatusSubscriber.
 *
 * @package Drupal\webcomposer_replicate_utility\EntityStatusSubscriber
 */
class EntityStatusSubscriber implements EventSubscriberInterface {

  /**
   * Set entity status to FALSE.
   *
   * @param ReplicateAlterEvent $event
   *   The event we're working on.
   */
  public function onClone(ReplicateAlterEvent $event) {
    $entity = $event->getEntity();
    if (!$entity instanceof Node) {
      return;
    }

    foreach ($entity->getTranslationLanguages() as $translation_language) {
      $langcode = $translation_language->getId();
      $translation = $entity->getTranslation($langcode);
      if ($translation->hasField('status')) {
        $translation->set('status', 0);
      }
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
