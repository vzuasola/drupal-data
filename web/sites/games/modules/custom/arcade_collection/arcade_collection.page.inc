<?php

/**
 * @file
 * Contains arcade_collection.page.inc.
 *
 * Page callback for Arcade collection entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Arcade collection templates.
 *
 * Default template: arcade_collection.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_arcade_collection(array &$variables) {
  // Fetch ArcadeCollection Entity Object.
  $arcade_collection = $variables['elements']['#arcade_collection'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
