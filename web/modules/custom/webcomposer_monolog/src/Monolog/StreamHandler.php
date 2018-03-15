<?php

namespace Drupal\webcomposer_monolog\Monolog;

use Drupal\Core\Site\Settings;

use Monolog\Logger;
use Monolog\Handler\StreamHandler as Base;

class StreamHandler extends Base {
  /**
   *
   */
  public function __construct($level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false) {
    $config = Settings::get('monolog');

    parent::__construct($config['path'], $config['level'], $bubble, $filePermission, $useLocking);
  }
}
