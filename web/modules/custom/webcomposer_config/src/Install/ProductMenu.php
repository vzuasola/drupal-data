<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class ProductMenu {

  public function createMenu()
  {
    $menu = array(
      '/' => 'Home'
    );

    WebcomposerConfig::createMenu('product-menu', $menu);
  }
}
