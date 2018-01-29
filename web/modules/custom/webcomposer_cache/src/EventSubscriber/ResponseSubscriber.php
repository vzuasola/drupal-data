<?php

/**
 * @file
 * Contains \Drupal\webcomposer_cache\EventSubscriber\ResponseSubscriber.
 */

namespace Drupal\webcomposer_cache\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Drupal\webcomposer_cache\Storage\SignatureStorageInterface;

/**
 * Provides ResponseSubscriber.
 */
class ResponseSubscriber implements EventSubscriberInterface {
  /**
   * Subscriber priority
   */
  const PRIORITY = -100;

  private $signatureManager;

  /**
   * Public constructor
   */
  public function __construct(SignatureStorageInterface $signatureManager) {
    $this->signatureManager = $signatureManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onRespond', self::PRIORITY];

    return $events;
  }

  /**
   *
   */
  public function onRespond(FilterResponseEvent $event) {
    if (!$event->isMasterRequest()) {
      return;
    }

    $request = $event->getRequest();
    $response = $event->getResponse();

    $response->headers->set('Cache-Signature', $this->signatureManager->getSignature());
  }
}
