<?php

/**
 * @file
 * Contains \DrupalProject\custom\ProductHandler.
 */

namespace DrupalProject\custom;

use Symfony\Component\HttpFoundation\Request;

class EnvironmentResolver {
  public static function getEnvironment() {
    return self::getEnvironmentFromRequest(\Drupal::request());
  }

  public static function getEnvironmentFromRequest(Request $request) {
    $environment = 'LOCAL';

    $hostname = $request->getHttpHost();

    if (preg_match('/(.*?)-/', $hostname, $matches)) {
      list(, $env) = $matches;

      $environment = strtoupper($env);
    }

    return $environment;
  }
}
