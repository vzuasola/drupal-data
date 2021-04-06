<?php

/**
 * @file
 * Contains jamboree_arcade_game_entity.page.inc.
 *
 * Page callback for Jamboree arcade game entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree arcade game entity templates.
 *
 * Default template: jamboree_arcade_game_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_arcade_game_entity(array &$variables) {
  // Fetch JamboreeArcadeGameEntity Entity Object.
  $jamboree_arcade_game_entity = $variables['elements']['#jamboree_arcade_game_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
