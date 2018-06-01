<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'jamboree-casino';
$databases['default']['default'] = array (
  'database' => 'jamboree',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'SojQ_oyeDWSW042rXy4KQcf__USxUqDbkbro3iGV7YZ-D6h4lQh2JZqU7qNH8dmhc0UUahyOrA';
$settings['install_profile'] = 'config_installer';
