<?php

/**
 * @file
 * Contains \Drupal\webcomposer_replicate_utility\EventSubscriber\SetReplicateDefaultLabel.
 */

namespace Drupal\webcomposer_replicate_utility\EventSubscriber;

use Drupal\replicate\Events\ReplicatorEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\replicate\Events\ReplicateAlterEvent;
use Drupal\Core\Entity\TranslatableInterface;

/**
 * Class SetReplicateDefaultLabel.
 *
 * @package Drupal\webcomposer_replicate_utility\EventSubscriber
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
    if ($entity->hasField('field_title') && $entity->hasField('name') && $entity instanceof TranslatableInterface) {
      foreach ($entity->getTranslationLanguages() as $translation_language) {
        $langcode = $translation_language->getId();
        $translation = $entity->getTranslation($langcode);
        $translated_title = $translation->get('name')->getString();
        $translation->set('field_title', $translated_title);
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
