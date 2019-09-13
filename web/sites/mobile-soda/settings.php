<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'product';


$databases['default']['default'] = array (
  'database' => 'mobile_soda1',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);

$settings['hash_salt'] = 'zqwSIHFNEVABYMvuBE214NEew3iBbt-rbVFUHM4EtVFmcvWtEt7CD2o6hAr55YISfomlaVW6Kw';
$settings['install_profile'] = 'config_installer';
