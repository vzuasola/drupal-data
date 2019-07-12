<?php

/**
 * @file
 * Contains client_footer_games.page.inc.
 *
 * Page callback for Client footer games entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Client footer games templates.
 *
 * Default template: client_footer_games.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_client_footer_games(array &$variables) {
  // Fetch ClientFooterGames Entity Object.
  $client_footer_games = $variables['elements']['#client_footer_games'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
