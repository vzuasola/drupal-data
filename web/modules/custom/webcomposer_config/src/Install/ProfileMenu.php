<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class ProfileMenu {

  public function createMenu()
  {
    $menu = array(
      '/' => 'My Account'
    );

    WebcomposerConfig::createMenu('profile-menu-sc', $menu);
    WebcomposerConfig::createMenu('profile-menu-ch', $menu);
  }
}
