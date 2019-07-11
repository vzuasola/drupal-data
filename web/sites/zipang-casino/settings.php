<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'zipang-casino';$databases['default']['default'] = array (
  'database' => 'zipang',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'xXouPNrZhKMP20MCF7NznDduHNMYILVMrpxHTLETiXjtwJMbhvc_b8mqQu3Qd-zD4TsdfwGebg';
$settings['install_profile'] = 'config_installer';