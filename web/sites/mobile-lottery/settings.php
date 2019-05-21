<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';
$databases['default']['default'] = array (
  'database' => 'mobile_lottery',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'AGeewUGQeEWw1ERMiUmPWT8BWC32EQhbYYk9qiUS5XqOwvYZKA-ep-oXN6wxl9oI3l4O972HAw';
$settings['install_profile'] = 'config_installer';
