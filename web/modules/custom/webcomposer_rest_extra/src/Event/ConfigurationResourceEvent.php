<?php

namespace Drupal\webcomposer_rest_extra\Event;

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
   * The config id.
   *
   * @var string
   */
  public $config_id;

  /**
   * Constructs the object.
   */
  public function __construct(&$data, &$config_id = null) {
    $this->data = &$data;
    $this->config_id = &$config_id;
  }
}