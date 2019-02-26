<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';
$databases['default']['default'] = array (
  'database' => 'zipang_revamp',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '11.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'e8jNA0_W_wObJrrlPMDSxdfx2PEsRM6VvBffkwhf9nYXtRbrPSYYk-0zeTkdi3I5cLggJ6X7sQ';
$settings['install_profile'] = 'config_installer';
