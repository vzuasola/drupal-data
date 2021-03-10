<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'mobile-entrypage';
$settings['primary_site_prefix'] = '';
$databases['default']['default'] = array (
  'database' => 'mobile_virtuals_2',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'ermmPZUJ53qKo0CbMhi0k5tOQWGMH0sM8uhZAL0vuZ1ebURZyV-liwYPaIo99QnPaK-BivOgFQ';
$settings['install_profile'] = 'fconfig_installer';
