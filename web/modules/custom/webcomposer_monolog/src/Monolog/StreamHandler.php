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
    $path = Settings::get('monolog_path');
    parent::__construct($path, $level, $bubble, $filePermission, $useLocking);
  }
}
