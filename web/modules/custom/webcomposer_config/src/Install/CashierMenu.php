<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class CashierMenu {

  public function createMenu()
  {
    $menu = array(
      '/' => 'Cashier'
    );

    WebcomposerConfig::createMenu('cashier-menu', $menu);
  }
}
