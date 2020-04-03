<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';
$databases['default']['default'] = array (
  'database' => 'root',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'mGfObQ0M3BABkV3h8lmXR-27V7QL5OlGpSRg4j_XClD3X_EOFyKUE_KqN17l0SyiInqvo77n7A';
$settings['install_profile'] = 'config_installer';
