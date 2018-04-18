<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'jamboree-casino';
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
$settings['hash_salt'] = 'x8O0skitlHOf4a3DO31qG9RJBLBrj5N6W9a6X8pene7_BR6qDFgfC_eomul7rplp7XYfbDx4Cg';
$settings['install_profile'] = 'config_installer';
