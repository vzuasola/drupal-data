<?php

namespace Drupal\webcomposer_monolog\Monolog\Handler;

use Drupal\Core\Site\Settings;

use Monolog\Logger;
use Monolog\Handler\FilterHandler as BaseFilterHandler;
use Monolog\Handler\StreamHandler as BaseStreamHandler;

/**
 * This handler combine a FilterHandler with a StreamHandler in order to restrict the range of
 * log levels that are logged and it uses a custom line formatter in order to avoid logging the
 * stacktrace which makes the log file size to grow very fast when many errors happen during a small
 * period of time.
 */
class LightStreamHandler extends BaseFilterHandler
{
  public function __construct($path, $minLevel = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false) {
    $settings = Settings::get('monolog');
    $logPath = (!is_null($path)) ? $path : $settings['path'];

    $maxLogLevel = Logger::EMERGENCY;
    $minLogLevel = \Drupal::config('webcomposer_config.monolog_configuration')->get('min_log_level');
    $logLevel = (!is_null($minLogLevel)) ? $minLogLevel : $minLevel;

    $format = new LightLineFormatter();
    $format->includeStacktraces(false); // We want to exclude stacktrace, though this doesn't seem to work.
    $this->setFormatter($format);

    $streamHandler = new BaseStreamHandler($logPath, $logLevel, $bubble, $filePermission, $useLocking);
    $streamHandler->setFormatter($format);

    parent::__construct($streamHandler, $minLogLevel, $maxLogLevel, $bubble);
  }
}
