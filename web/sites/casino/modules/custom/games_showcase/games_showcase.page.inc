<?php

/**
 * @file
 * Contains games_showcase_entity.page.inc.
 *
 * Page callback for Games Showcase entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Games Showcase entity templates.
 *
 * Default template: games_showcase_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_games_showcase_entity(array &$variables) {
  // Fetch GamesShowcaseEntity Entity Object.
  $games_showcase_entity = $variables['elements']['#games_showcase_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
