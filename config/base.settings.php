<?php

/**
 * @file
 * Drupal site-specific configuration file.
 */

$databases = [];
$config_directories = [];

/**
 * Cache backend settings
 *
 */

$settings['container_yamls'][] = DRUPAL_ROOT . '/modules/contrib/redis/redis.services.yml';
$settings['cache']['default'] = 'cache.backend.redis';

/**
 * Dynamic Sentinel Redis
 *
 * Fetch values from env and parse Sentinel hosts
 */

if (isset($_SERVER['REDIS_SERVER']) && isset($_SERVER['REDIS_SERVICE'])) {
  $clients = \DrupalProject\helper\Sentinel::resolve($_SERVER['REDIS_SERVER']);
  $redisService = $_SERVER['REDIS_SERVICE'];

  $options = [
    'replication' => 'sentinel',
    'service' => $redisService,
    'parameters' => ['database' => 1],
  ];

  $settings['webcomposer_cache']['redis'] = [
    'clients' => $clients,
    'options' => $options,
  ];

  $settings['redis.connection']['interface'] = 'Predis';
  $settings['redis.connection']['host'] = $clients;
  $settings['redis.connection']['options'] = $options;
}

/**
 * Access control for update.php script.
 *
 * If you are updating your Drupal installation using the update.php script but
 * are not logged in using either an account with the "Administer software
 * updates" permission or the site maintenance account (the account that was
 * created during installation), you will need to modify the access check
 * statement below. Change the FALSE to a TRUE to disable the access check.
 * After finishing the upgrade, be sure to open this file again and change the
 * TRUE back to a FALSE!
 */
$settings['update_free_access'] = FALSE;

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 *
 * This variable will be set to a random value by the installer. All one-time
 * login links will be invalidated if the value is changed. Note that if your
 * site is deployed on a cluster of web servers, you must ensure that this
 * variable has the same value on each server.
 *
 * For enhanced security, you may set this variable to the contents of a file
 * outside your document root; you should also ensure that this file is not
 * stored with backups of your database.
 *
 * Example:
 * @code
 *   $settings['hash_salt'] = file_get_contents('/home/example/salt.txt');
 * @endcode
 */
$settings['hash_salt'] = md5($site_path);

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see file_scan_directory()
 * @see \Drupal\Core\Extension\ExtensionDiscovery::scanDirectory()
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * Public file base URL:
 *
 * An alternative base URL to be used for serving public files. This must
 * include any leading directory path.
 *
 * A different value from the domain used by Drupal to be used for accessing
 * public files. This can be used for a simple CDN integration, or to improve
 * security by serving user-uploaded files from a different domain or subdomain
 * pointing to the same server. Do not include a trailing slash.
 */
if (isset($_SERVER['HTTP_X_FE_BASE_URI'])) {
  $settings['file_public_base_url'] =  $_SERVER['HTTP_X_FE_BASE_URI'];
}

/**
 * The product code
 *
 * This should be overriden by implementing products
 */
$settings['product'] = $site_path;

/**
 * The default installation profile
 */
$settings['install_profile'] = 'config_installer';

/**
 * The config sync directory
 */
$config_directories['sync'] = $app_root . '/' . $site_path . '/config/sync';

/**
 * Monolog settings
 */
$settings['monolog'] = [
  'path' => '/var/log/cms/webcomposer.log',
  'level' => \Monolog\Logger::INFO,
];

/**
 * Attempt to load database configuration
 */
if (file_exists($app_root . '/' . $site_path . '/database.php')) {
  require $app_root . '/' . $site_path . '/database.php';
} elseif (file_exists($app_root . '/' . $site_path . '/database.local.php')) {
  // special handling for local
  require $app_root . '/' . $site_path . '/database.local.php';
}

/**
 * Check if we need to load the development configurations
 */
$env = getenv('DRUPAL_ENV');

if ($env && $env == 'local') {
  require __DIR__ . '/base.settings.local.php';

  $config['system.logging']['error_level'] = 'verbose';
}
