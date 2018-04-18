<?php

// include the base settings
require $app_root . '/../config/base.settings.php';
$databases['default']['default'] = array (
  'database' => 'jamboree',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'e-DLvANZ6HVcSjaFBi2s7J2Oni7m0y6jkuyHHfQ2boT2qSIgubgpuON3SDu4BuLU-wxz8xX_rA';
$settings['install_profile'] = 'config_installer';
$config_directories['sync'] = '/var/www/webcomposer/drupal/web/sites/jamboree-casino/config/sync';
