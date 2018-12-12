<?php

/**
 * @file
 * Contains games_collection.page.inc.
 *
 * Page callback for Games Collection entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Games Collection templates.
 *
 * Default template: games_collection.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_games_collection(array &$variables) {
  // Fetch GamesCollection Entity Object.
  $games_collection = $variables['elements']['#games_collection'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
