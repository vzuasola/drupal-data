<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class SecondaryMenu {

  public function createMenu()
  {
    $menu = array(
      '/promotions' => 'Promotions',
      '/mobile' => 'Mobile'
    );

    WebcomposerConfig::createMenu('secondary-menu', $menu);
  }
}
