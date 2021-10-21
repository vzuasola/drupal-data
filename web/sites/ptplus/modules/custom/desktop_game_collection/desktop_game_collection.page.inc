<?php

/**
 * @file
 * Containsdesktop_game_collection.page.inc.
 *
 * Page callback forDesktop game collection entities. 
 */

 use Drupal\Core\Render\Element;
 
 /**
 * Prepares variables forDesktop game collection templates.
 *
 * Default template:desktop_game_collection.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_desktop_game_collection(array &$variables) {
  // FetchDesktopGameCollection Entity Object.
  $desktop_game_collection = $variables['elements']['#desktop_game_collection'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
