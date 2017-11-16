<?php

/**
 * @file
 * Contains \DrupalProject\custom\ProductHandler.
 */

namespace DrupalProject\custom;

use Composer\Script\Event;
use Composer\Semver\Comparator;
use Symfony\Component\Filesystem\Filesystem;

class ProductHandler {
  protected static function getDrupalRoot($project_root) {
    return $project_root . '/web';
  }

  /**
   * Create a new product instance
   */
  public static function createNewInstance(Event $event) {
    $arguments = $event->getArguments();

    if (!empty($arguments[0])) {
      $site = $arguments[0];

      try {
        self::createInstance($site);
        $event->getIO()->write("Instance for $site has been created successfully");
      } catch (\Exception $e) {
        $event->getIO()->writeError($e->getMessage());
        $event->getIO()->writeError("Error creating site instance for $site");
      }
    } else {
      $event->getIO()->writeError('No argument for site name was specified');
    }
  }

  /**
   *
   */
  protected static function createInstance($sitename) {
    $fs = new Filesystem();
    $cwd = getcwd();

    if ($fs->exists("$cwd/web/sites/$sitename")) {
      throw new \Exception("Site instance $sitename already exists");
    }

    $fs->mirror("$cwd/profiles/dafabet", "$cwd/web/sites/$sitename");
  }
}
