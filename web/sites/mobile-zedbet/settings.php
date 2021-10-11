<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'mobile-zedbet';
$settings['ck_editor_inline_image_prefix'] = '/en/mobile-zedbet';
$databases['default']['default'] = array (
  'database' => 'mobile_zedbet',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'nAnOgvRkuq0M3zDHzZmysrxyB6fbl336Kd9u4SkJbOY-csnrb6t2mgVyBU0HMsvF_TZHAGle7w';
$settings['install_profile'] = 'config_installer';
