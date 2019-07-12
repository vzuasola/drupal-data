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
  const HEADER = 'Cache-Signature';

  /**
   * Subscriber priority
   */
  const PRIORITY = -100;

  /**
   * The signature manager
   *
   * @var SignatureStorageInterface
   */
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

    $enable = \Drupal::config('webcomposer_cache.settings')->get('enable');

    if ($enable) {
      $request = $event->getRequest();
      $response = $event->getResponse();

      $response->headers->set(self::HEADER, $this->signatureManager->getSignature());
    }
  }
}
