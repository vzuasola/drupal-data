<?php

/**
 * @file
 * Drupal site-specific configuration file for development
 */

/**
 * Redis host
 */
$settings['webcomposer_cache']['redis'] = [
  'clients' => 'tcp://10.5.0.7:6379',
  'options' => [
      'parameters' => ['database' => 1],
  ],
];

/**
 * Monolog path
 */
$settings['monolog_path'] = DRUPAL_ROOT . '/../logs/webcomposer.log';

/**
 * Attempt to load local database configuration
 */
if (file_exists($app_root . '/' . $site_path . '/database.local.php')) {
  require $app_root . '/' . $site_path . '/database.local.php';
}
