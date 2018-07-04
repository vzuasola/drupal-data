<?php

/**
 * @file
 * Contains jamboree_desktop_games_entity.page.inc.
 *
 * Page callback for Jamboree desktop games entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree desktop games entity templates.
 *
 * Default template: jamboree_desktop_games_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_desktop_games_entity(array &$variables) {
  // Fetch JamboreeDesktopGamesEntity Entity Object.
  $jamboree_desktop_games_entity = $variables['elements']['#jamboree_desktop_games_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
