<?php

namespace Drupal\webcomposer_monolog\Monolog\Handler;

use Drupal\Core\Site\Settings;

use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler as Base;

class StreamHandler extends Base {
  /**
   *
   */
  public function __construct($level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false) {
    $config = Settings::get('monolog');

    $format = new JsonFormatter();
    $this->setFormatter($format);

    parent::__construct($config['path'], $config['level'], $bubble, $filePermission, $useLocking);
  }
}
