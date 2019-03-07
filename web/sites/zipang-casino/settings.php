<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'zipang-casino';
$databases['default']['default'] = array (
 'database' => 'zipang_revamp2',
 'username' => 'root',
 'password' => 'secret',
 'prefix' => '',
 'host' => '10.5.0.6',
 'port' => '3306',
 'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
 'driver' => 'mysql',
);

$settings['hash_salt'] = 'd0udywWtUWRlTpd4zSDju9CgqMdNJ9OJ2fJAuW12F8prlyeBofSYM4XJkCSe1d8mtYevXK1w5Q';
$settings['install_profile'] = 'config_installer';