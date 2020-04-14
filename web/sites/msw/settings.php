<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'msw';
$settings['primary_site_prefix'] = '';

$settings['ck_editor_inline_image_prefix'] = '/en/msw';
$databases['default']['default'] = array (
  'database' => 'msw',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'N3gXVTn9PsCZaKlkbIDc3iCe3GZ4FHCcxpNdh4JdGchhRzM2Y_nTHvRCNMRE3Y2XRnfWQjWymA';
$settings['install_profile'] = 'config_installer';
