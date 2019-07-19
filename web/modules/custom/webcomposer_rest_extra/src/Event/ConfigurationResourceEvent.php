<?php

namespace Drupal\webcomposer_rest_extra\Event;

use Drupal\user\UserInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event that is fired when a user logs in.
 */
class ConfigurationResourceEvent extends Event {

  const EVENT_NAME = 'get_config';

  /**
   * The data array.
   *
   * @var array
   */
  public $data;

  /**
   * Constructs the object.
   */
  public function __construct(&$data) {
    $this->data = &$data;
  }
}