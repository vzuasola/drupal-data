<?php

namespace Drupal\webcomposer_monolog\Monolog\Handler;

use Drupal\Core\Site\Settings;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler as Base;

class StreamHandler extends Base {
  /**
   *
   */
  public function __construct($path = null, $level = null, $bubble = true, $filePermission = null, $useLocking = false) {
    $config = Settings::get('monolog');

    $logPath = (!is_null($path)) ? $path : $config['path'];
    $logLevel = (!is_null($level)) ? $level : $config['level'];

    $format = new LineFormatter();
    $this->setFormatter($format);

    parent::__construct($logPath, $logLevel, $bubble, $filePermission, $useLocking);
  }
}
