<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';
$databases['default']['default'] = array (
  'database' => 'faqs',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = '_bmtTbTeni6kpzwwPZ4J5uzEH51shEJu0644bvuFGDo1UejtvaLFjTyDYEXFJ3Gi6RMY-aDRsQ';
$settings['install_profile'] = 'config_installer';
