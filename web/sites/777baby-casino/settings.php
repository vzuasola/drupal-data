<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';
$databases['default']['default'] = array (
  'database' => '777baby',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '11.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'zKEwDByjwt5uTa7GMhh9U8OTRMZw0hId23NSeljcqmxsY1eTUF_5tQfDDQUykGUoaj4MIfQE-A';
$settings['install_profile'] = 'config_installer';
