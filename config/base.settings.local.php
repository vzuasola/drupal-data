<?php

/**
 * @file
 * Drupal site-specific configuration file for development
 */

/**
 * Attempt to load local database configuration
 */
if (file_exists($app_root . '/' . $site_path . '/database.local.php')) {
  require $app_root . '/' . $site_path . '/database.local.php';
}
