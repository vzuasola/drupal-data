<?php

/**
 * @file
 * Contains \DrupalProject\composer\SettingsHandler.
 */

namespace DrupalProject\composer;

use Composer\Script\Event;
use Composer\Semver\Comparator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Handles settings synchronization and automation
 */
class SettingsHandler
{
    protected static function getConfigRoot($projectRoot)
    {
        return $projectRoot . '/config';
    }

    protected static function getSitesRoot($projectRoot)
    {
        return $projectRoot . '/web/sites';
    }

    /**
     * Syncs the files in the config directory to their respective sites 
     * directory
     */
    public static function syncSettings(Event $event)
    {
        $fs = new Filesystem();

        $configs = static::getConfigRoot(getcwd());
        $sites = static::getSitesRoot(getcwd());

        $finder = new Finder();
        $finder->directories()->in($sites)->depth('== 0');

        foreach ($finder as $directory) {
          $product = $directory->getFileName();

          if ($fs->exists("$configs/$product.settings.php")) {
            try {
              $fs->symlink("$configs/$product.settings.php", "$directory/settings.php", true);
            } catch (\Exception $e) {
              $fs->copy("$configs/$product.settings.php", "$directory/settings.php", true);
            }
            $fs->chmod("$directory/settings.php", 0666);
          }
        }
    }
}
