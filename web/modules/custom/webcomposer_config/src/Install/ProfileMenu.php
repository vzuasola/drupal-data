<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

/**
 * Produst Menu.
 */
class ProfileMenu {

  /**
   * Create Product Menu.
   */
  public function createMenu() {
    $menu = [
      '/' => 'My Account',
    ];

    WebcomposerConfig::createMenu('profile-menu', $menu);
  }

}
