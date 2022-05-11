<?php

/**
 * @file
 * Contains lucky_baby_all_games_entity.page.inc.
 *
 * Page callback for Lucky Baby all games entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lucky Baby all games entity templates.
 *
 * Default template: lucky_baby_all_games_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lucky_baby_all_games_entity(array &$variables) {
  // Fetch Lucky BabyAllGamesEntity Entity Object.
  $lucky_baby_all_games_entity = $variables['elements']['#lucky_baby_all_games_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
