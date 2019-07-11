<?php

namespace Drupal\webcomposer_config\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class NotifySubscriber.
 */
class NotifySubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['notifySchema'];
    return $events;
  }

  public function notifySchema() {
    $route_name = \Drupal::routeMatch()->getRouteName();

    if ($route_name === 'system.admin_config') {
      if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
        $message = t("It looks like you have not enabled the <strong>
          Webcomposer Config Schema</strong> yet. Please enable this module as this
          will be a mandatory requirement in the near future.
          <strong>Don't tell us we didn't warn you</strong>.");

        drupal_set_message($message, 'warning');
      }
    }
  }
}
