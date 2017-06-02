<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class ProductMenuRight {

  public function createMenu()
  {
    $menu = array(
      '/promotions' => 'Promotions',
      '/mobile' => 'Mobile'
    );

    WebcomposerConfig::createMenu('product-menu-right', $menu);
  }
}
