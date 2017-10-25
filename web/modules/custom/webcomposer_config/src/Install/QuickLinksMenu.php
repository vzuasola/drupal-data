<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

/**
 * QuickLinks Menu.
 */
class QuickLinksMenu {

  /**
   * Create QuickLinks Menu.
   */
  public function createMenu() {
    $menu = [
      '/' => 'About Us',
    ];

    WebcomposerConfig::createMenu('quicklinks', $menu);
  }

}
