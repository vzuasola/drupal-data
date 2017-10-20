<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

/**
 * Secondary Menu.
 */
class SecondaryMenu {

  /**
   * Create Secondary Menu.
   */
  public function createMenu() {
    $menu = [
      '/promotions' => 'Promotions',
      '/mobile' => 'Mobile',
    ];

    WebcomposerConfig::createMenu('secondary-menu', $menu);
  }

}
