<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'poker';

/**
 * The main URL prefix for this site instance
 */
$settings['primary_site_prefix'] = 'poker';

/**
 * The front end prefix that CKEditor will append for all products
 */
	$databases['default']['default'] = array (
  'database' => 'poker',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = '-YIgp2z3jF_qOT218_qz8ulYyOdPCuYRA8pAjgDElbxYOzlEGQjPgU1zgUZddixKmcdE8mKGgA';
$settings['install_profile'] = 'config_installer';
