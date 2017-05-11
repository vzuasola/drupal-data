<?php

namespace Drupal\webcomposer_config\Install;

use Drupal\webcomposer_config\WebcomposerConfig;

class QuickLinksMenu {

  public function createMenu()
  {
    $menu = array(
      '/' => 'About Us'
    );

    WebcomposerConfig::createMenu('quicklinks-sc', $menu);
    WebcomposerConfig::createMenu('quicklinks-ch', $menu);
  }
}
