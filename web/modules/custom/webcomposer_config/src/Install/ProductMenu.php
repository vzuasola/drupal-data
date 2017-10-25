<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

/**
 * Product Menu.
 */
class ProductMenu {

  /**
   * Create Product Menu.
   */
  public function createMenu() {
    $menu = [
      '/' => 'Home',
    ];

    WebcomposerConfig::createMenu('product-menu', $menu);
  }

}
