<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'mobile-entrypage';
$settings['primary_site_prefix'] = '';

if (isset($_SERVER['REDIS_SERVER']) && isset($_SERVER['REDIS_SERVICE'])) {
    $settings['cache']['default'] = 'cache.backend.redis';
    $settings['cache_prefix'] = "drupal.cache.$product";
}
