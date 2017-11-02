<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

/**
 * Cashier Menu.
 */
class CashierMenu {

  /**
   * Create cashier menu.
   */
  public function createMenu() {
    $menu = [
      '/' => 'Cashier',
    ];

    WebcomposerConfig::createMenu('cashier-menu', $menu);
  }

}
