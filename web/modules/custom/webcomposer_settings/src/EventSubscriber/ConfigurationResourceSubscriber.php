<?php

namespace Drupal\webcomposer_settings\EventSubscriber;

use Drupal\webcomposer_rest_extra\Event\ConfigurationResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class UserLoginSubscriber.
 *
 * @package Drupal\webcomposer_settings\EventSubscriber
 */
class ConfigurationResourceSubscriber implements EventSubscriberInterface {

  /**
   * Date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      ConfigurationResourceEvent::EVENT_NAME => 'configAlter',
    ];
  }

  /**
   * Subscribe to the user login event dispatched.
   *
   * @param \Drupal\webcomposer_rest_extra\Event\ConfigurationResourceEvent $event
   */
  public function configAlter($event) {
    $settings = \Drupal::service('config.factory')->get('webcomposer_settings.form_fields_filter_settings')->get();

    foreach (array_keys($event->data) as $key) {
      if (isset($settings[$key]) && $settings[$key] == 0) {
        unset($event->data[$key]);
      }
    }
  }

}