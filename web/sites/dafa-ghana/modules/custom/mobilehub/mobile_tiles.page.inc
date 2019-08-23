<?php

/**
 * @file
 * Contains mobile_tiles.page.inc.
 *
 * Page callback for Mobile tiles entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile tiles templates.
 *
 * Default template: mobile_tiles.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_tiles(array &$variables) {
  // Fetch MobileTiles Entity Object.
  $mobile_tiles = $variables['elements']['#mobile_tiles'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
