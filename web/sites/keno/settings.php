<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'keno';

/**
 * The main URL prefix for this site instance
 */
$settings['primary_site_prefix'] = 'keno';

/**
 * The front end prefix that CKEditor will append for all products
 */
$settings['ck_editor_inline_image_prefix'] = '/en/keno';
$databases['default']['default'] = array (
  'database' => 'keno',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
