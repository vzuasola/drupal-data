<?php

/**
 * @file
 * Contains jamboree_live_game_entity.page.inc.
 *
 * Page callback for Jamboree live game entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree live game entity templates.
 *
 * Default template: jamboree_live_game_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_live_game_entity(array &$variables) {
  // Fetch JamboreeLiveGameEntity Entity Object.
  $jamboree_live_game_entity = $variables['elements']['#jamboree_live_game_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
