<?php

// include the base settings
require $app_root . '/../config/base.settings.php';

/**
 * The product code
 */
$settings['product'] = 'dafa-ghana';

$databases['default']['default'] = array (
  'database' => 'dafa-ghana',
  'username' => 'root',
  'password' => 'secret',
  'prefix' => '',
  'host' => '10.5.0.6',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'MtgU5YxMpVNC5H_wM_4Bjzdq1qoDSW3jumJEFp_toWyHQ4WtsOfRoPui9uTtkdzSrukQOMGd_w';
$settings['install_profile'] = 'config_installer';
$config_directories['sync'] = 'sites/dafa-ghana/files/config_Z1NftilX1vbOSd70clpjLYTUkkGfZQCgIKfwXGxFAEkOGfeB4nkA2Uup8DmAbdWyyarIVkByLQ/sync';
/**
 * The front end prefix that CKEditor will append for all products
 */
$settings['ck_editor_inline_image_prefix'] = '/en';
